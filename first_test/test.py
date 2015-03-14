import sys, os
import my_recognizer as sr
import pyaudio

r = sr.MyRecognizer()
# TODO : energy_threshold must be dynamically determined
r.energy_threshold = 800 # minimum audio energy to consider for recording
r.pause_threshold = 0.2 # seconds of quiet time before a phrase is considered complete
r.quiet_duration = 0.18 # amount of quiet time to keep on both sides of the recording

play_audio = True
out_stream = None

wav_filename = sys.argv[1]
#wav_filename = 'C4_1_mono.wav'
current_time = 0
with sr.WavFile(wav_filename) as source: # use "test.wav" as the audio source
    wav_size = source.wav_reader.getfp().getsize()
    if play_audio:
        # create an audio object
        p = pyaudio.PyAudio()
    
    while True:
        audio, front_time, talk_time, end_time, frame_data = r.listen(source, 10) # extract audio data from the file
        if audio:
            list = None
            try:
                if play_audio:
                    if not out_stream:
                        # open stream based on the wave object which has been input.
                        out_stream = p.open(format =
                                        p.get_format_from_width(source.wav_reader.getsampwidth()),
                                        channels = source.wav_reader.getnchannels(),
                                        rate = source.wav_reader.getframerate(),
                                        output = True)
                        pass
                    # writing to the stream is what *actually* plays the sound.
                    out_stream.write(frame_data)
                    pass
                    
                list = r.recognize(audio, True) # generate a list of possible transcriptions
                #print("Possible transcriptions:")
                #for prediction in list:
                #    print(" " + prediction["text"] + " (" + str(prediction["confidence"]*100) + "%)")
            except LookupError: # speech is unintelligible
                #print("Could not understand audio")
                pass
            if list and len(list) > 0:
                print current_time + front_time, current_time + front_time + talk_time, list[0]['text']
            else:
                print current_time + front_time, current_time + front_time + talk_time, "***ERROR***"
                print end_time
        
        current_time += front_time + talk_time + end_time
    
        pos = source.wav_reader.getfp().tell()
        if pos >= wav_size:
           break
    
    # cleanup
    if out_stream:
        out_stream.close()
    if p:
        p.terminate()