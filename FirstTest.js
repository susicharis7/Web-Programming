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

// Arrays & Objects

// Arrays store multiple values
let colors = ["Red","Green","Blue"];
console.log(colors[1]);

// Objects store key-value pairs
let car = {brand: "Tesla", model: "Model S", year: 2022};
console.log(car.model);

// JS DOM Manipulation (Document Object Model) allows JS to interact with HTML Elements
document.getElementById("demo").innerHTML = "Hello again!";
/*
Dole komanda pronalazi prvi element na HTML dokumentu koji ima klasu "className"
Ako postoji vise elemenata sa tom klasom, uzima samo prvi koji nadje
AKO ZELIMO SVE ELEMENTE : "document.querySelectorAll(".className").forEach(function(el))""
*/
// document.querySelector(".className").style.color="red";

let element = document.querySelector(".className");
    if(element) {
        element.style.color = "red";
    } else {
        console.log("Not found");
    }



// Creating & Appending Elements
let newElement = document.createElement("p"); // pravi novi HTML <p> , ali ga jos ne stavlja u stranicu
newElement.innerHTML = "New Paragraph!"; // unutar tog p, postavlja "New Paragraph!" text
document.body.appendChild(newElement); // doda taj paragraf na kraj <body> elementa u HTML dokumentu, i postaje vidljiv na ekranu

/*
Output Methods
- innerHTML : changes content inside HTML Element
- console.log() : logs messages to the browser console (for debugging)
- window.alert() : displays an alert popup
- document.write() : writes directly into the document (not recommended)
*/

document.getElementById("demoSecond").innerHTML = "Hello Boy!";
console.log("This is a message");
// alert("Warning!");
// document.write("Writing directly from JS...");



