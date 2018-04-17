from flask import *
from math import *
app = Flask(__name__)

#module function
def calci(num1,num2,opertion):
	if(opertion=='+'):
		return int(num1) + int (num2)
	elif(opertion=='-'):
		return int(num1) - int (num2)
	elif(opertion=='*'):
		return int(num1) * int (num2)
	elif(opertion=='/'):
		return int(num1) / int (num2)	
	elif(opertion=='sin'):
		return sin(int(num1)) 
	elif(opertion=='cos'):
		return   cos(int (num1))
	elif(opertion=='sqrt'):
		return  sqrt(int (num1))

def currency(currency,opertion):
	if(opertion=='uti'):
		return int(currency)*65
	if(opertion=='itu'):
		return int(currency)/65
	if(opertion=='pti'):
		return int(currency)*85
	if(opertion=='itp'):
		return int(currency)/85
	


#route function
@app.route('/calculator' , methods = ['POST'])
def calculator():
	num1 =  request.form['num1']
	num2 =  request.form['num2']
	opertion= request.form['op']
	print (opertion)
	result = calci(num1,num2,opertion)
	return render_template('index.html' , Result = result) 


@app.route('/currency' , methods = ['POST'])
def currencyConverter():
	currency1 = request.form['inputCurrency']
	opertion = request.form['op']
	result1 = currency(currency1,opertion)
	return render_template('index.html' , Result1 = result1)

@app.route('/')
def index():
	return render_template("index.html")

if __name__ == '__main__':
	app.run(debug = True)