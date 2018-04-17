from flask import *
app=Flask(__name__)

#module function
messages = []

#route function
@app.route('/chat', methods = ['POST'])
def chat():
	message = request.form['message']
	messages.append(message)
	return redirect('http://127.0.0.1:5000/')	
	

@app.route('/')
def index():
	return render_template("index.html" , msglist = messages)



if __name__ == '__main__':
	app.run(debug = True)