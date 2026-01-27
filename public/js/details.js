const params = new URLSearchParams(window.location.search);
const service = params.get("service");

const data = {
health:{
   title; "Healthcare Services",
    descrption:"Access health centers,appointments,vaccination information and medical assistance."},

education:{
    title:"Education Services",
   descrption:"Find information about schools,registrations,digital platforms and student support".}
,

admin:{
    title: "Municipal Administration",
    descrption:
    "Submit municipal requests,documents,certificates and administrative services."
},



transport: {
   title:"Transportation Services",
   descrption:"Apply online for certificates ,personal documents and official forms."

},

documents: {
    title:"Online requests",
    descrption:"Submit complasints,digital forms and service reports online."
}

};



const titleEl = document.getElementById("service-title");
const descEl = document.getElementById("service-description");

if(data[service]) {
titleEl.textContent = data[service].title;
descEl.textContent = data[service].descrption;


} 
else 
    {
  titleEl.textContent = "Service not found";
descEl.textContent = "The selected service does not exist";
else



}