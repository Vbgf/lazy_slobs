from speech_recognition import *

class MyRecognizer(Recognizer):
    def listen(self, source, timeout = None):
        assert isinstance(source, AudioSource) and source.stream

        # record audio data as raw samples
        frames = collections.deque()
        assert self.pause_threshold >= self.quiet_duration >= 0
        seconds_per_buffer = (source.CHUNK + 0.0) / source.RATE
        pause_buffer_count = int(math.ceil(self.pause_threshold / seconds_per_buffer)) # number of buffers of quiet audio before the phrase is complete
        quiet_buffer_count = int(math.ceil(self.quiet_duration / seconds_per_buffer)) # maximum number of buffers of quiet audio to retain before and after
        front_time = 0

        # store audio input until the phrase starts
        while True:
            front_time += seconds_per_buffer
            if timeout and front_time > timeout: # handle timeout if specified
                return None, front_time, 0, 0

            buffer = source.stream.read(source.CHUNK)
            if len(buffer) == 0: break # reached end of the stream
            frames.append(buffer)

            # check if the audio input has stopped being quiet
            energy = audioop.rms(buffer, source.SAMPLE_WIDTH) # energy of the audio signal
            if energy > self.energy_threshold:
                break

            if len(frames) > quiet_buffer_count: # ensure we only keep the needed amount of quiet buffers
                frames.popleft()
                
        # read audio input until the phrase ends
        talk_time = 0
        pause_count = 0
        while True:
            talk_time += seconds_per_buffer
            if timeout and talk_time > timeout: # handle timeout if specified
                break
                
            buffer = source.stream.read(source.CHUNK)
            if len(buffer) == 0: break # reached end of the stream
            frames.append(buffer)

            # check if the audio input has gone quiet for longer than the pause threshold
            energy = audioop.rms(buffer, source.SAMPLE_WIDTH) # energy of the audio signal
            if energy > self.energy_threshold:
                pause_count = 0
            else:
                pause_count += 1
            if pause_count > pause_buffer_count: # end of the phrase
                break

        # remove extra quiet frames at the end
        end_time = 0
        for i in range(quiet_buffer_count, pause_count): 
            frames.pop()
            end_time += seconds_per_buffer
            talk_time -= seconds_per_buffer
        
        # obtain frame data
        frame_data = b"".join(list(frames))
        
        return AudioData(source.RATE, self.samples_to_flac(source, frame_data)), front_time, talk_time, end_time

