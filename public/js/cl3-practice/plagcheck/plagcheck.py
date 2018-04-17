from flask import *
import re
app = Flask(__name__)

#module function
def checkplag(text):
	#storedFileContent contains file contents with eliminated new line characters
    	storedFileContent = ' '.join(' '.join(open('store.txt','r+').read().split('\n')).split('.')).split()

    	print(storedFileContent)

    	#Reading data sent by user
    	text = str.replace(text,'\r','')
    	# text = str.replace(text,'.',' ') 
    	# shit syntax but works 
   	# you can use severel times replace statement   
    	submittedText = ' '.join(' '.join(text.split('\n')).split('.')).split()



    	print(submittedText)
    	plagCount = 0
    	for storedWord in storedFileContent:
        	for word in submittedText:
            		if word in storedWord:
                		if plagCount < len(storedFileContent):
                    			plagCount = plagCount + 1 
                		else:
                    			return(plagCount/len(storedFileContent)*100)
	

#route function
@app.route('/check', methods = ['POST'])
def check():
	input = request.form["text"]
	return render_template("index.html" , result=checkplag(input))

@app.route('/')
def index():
	return render_template("index.html")

if __name__ == '__main__':
	app.run(debug = True)