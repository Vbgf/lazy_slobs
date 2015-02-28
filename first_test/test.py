import sys
import my_recognizer as sr

r = sr.MyRecognizer()
r.energy_threshold = 100 # minimum audio energy to consider for recording
r.pause_threshold = 0.8 # seconds of quiet time before a phrase is considered complete
r.quiet_duration = 0.5 # amount of quiet time to keep on both sides of the recording
current_time = 0
with sr.WavFile(sys.argv[1]) as source: # use "test.wav" as the audio source
    while True:
        audio, front_time, talk_time, end_time = r.listen(source, 10) # extract audio data from the file

        if audio:
            list = None
            try:
                list = r.recognize(audio,True) # generate a list of possible transcriptions
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
        
        current_time += front_time + talk_time + end_time
        
        #if (source() != 0):
        #   break
            