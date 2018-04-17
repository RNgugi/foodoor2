from flask import *
app = Flask(__name__)
#module functions

def oddEven(arr, n):
	sorted=0
	while(sorted==0):
		sorted=1
		for i in range(1,n-1,2):
			if arr[i]>arr[i+1]:
				arr[i],arr[i+1]=arr[i+1],arr[i]
				sorted=0

		for i in range(0,n-1,2):
			if arr[i]>arr[i+1]:
				arr[i],arr[i+1]=arr[i+1],arr[i]
				sorted=0

	return
			

#route function
@app.route('/sort', methods = ['POST'])
def sort():
	number = request.form['array']
	dataset = []
	for item in number.split(','):
		dataset.append(int(item))

	oddEven(dataset,len(dataset))
	return render_template('index.html' , array1 = dataset , num_list = number)

	

@app.route('/')
def index():
	return render_template('index.html')	



if __name__=='__main__':
	app.run(debug = True)