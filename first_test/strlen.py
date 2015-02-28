import pysrt
import os

def max_subs_len (path):
	subs = pysrt.open(path, encoding='iso-8859-1')
	# res = [None]*len(subs)

	# for i in range(0, len(subs)):
		# time = subs[i].end - subs[i].start
		# res[i] = time.seconds
	# res = sorted(res)
	#return res[len(subs)-1]
	return max((sub.end - sub.start).seconds for sub in subs)
	
def get_paths(directory, file = ''):
    file_paths = []
    for root, directories, files in os.walk(directory):
        for filename in files:
			if not filename.endswith(file):
				continue
			else:
				filepath = os.path.join(root, filename)
				file_paths.append(filepath)
    return file_paths
 
all_movies = get_paths("//CLOUD/public/Videos", '.srt')

for path in all_movies:
	path = path.replace('\\', '/')
	print max_subs_len(path), path.split('/')[-1]