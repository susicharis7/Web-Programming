let x,y,z;
x = 5;
y = 6;
z = x + y;
console.log(z);

// var 

var a = 5;
a = 10; // can change
var a = 20; // can be defined again
console.log(a);

// let
let b = 5;
b = 15; // can change
// let b = 20; // cannot be defined again in the same block
console.log(b);

// const
const c = 50;
// c = 100; // cannot change
// const z = 200; // cannot define again


let person = {firstName: "Haris", age: 21};
console.log(person.firstName); // Output : Haris


// Functions

function greet(name) {
    return "Hello, " + name;
}
console.log(greet("Sumea"));

// Arrow Functions (Syntax)

const greetS = (name) => `Hello, ${name}`;
console.log(greetS("Bobby")); 

// Events - JS reacts to events like clicks, mouse movements, and keystrokes
// <button onclick="displayMessage()">Click Me</button>
function displayMessage() {
    document.getElementById("demoSecond").innerHTML = "Button Clicked!";
}