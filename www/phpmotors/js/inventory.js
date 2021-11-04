'use strict';

// Get a list of vehicles in inventory based on the classificationId 
let classificationList = document.querySelector("#classificationList");
classificationList.addEventListener("change", () => {
    let classificationId = classificationList.value;
    console.log(`classificationId is: ${classificationId}`);
    let classIdURL = "/phpmotors/vehicles/index.php?action=getInventoryItems&classificationId=" + classificationId;
    fetch(classIdURL)
        .then((response) => {
            if (response.ok) {
                return response.json();
            }
            throw Error("Network response was not OK");
        })
        .then((data) => {
            console.log(data);
            buildInventoryList(data);
        })
        .catch((error) => { console.log('There was a problem: ', error.message) });
});

// build inventory items into HTML table components and inject into DOM
function buildInventoryList(data) {
    let inventoryDisplay = document.getElementById("inventoryDisplay");
    if (data.length === 0) {
        inventoryDisplay.innerHTML = "";
        return;
    }

    // Setup table labels
    let dataTable = '<thead>';
    dataTable += '<tr><th>Vehicle Name</th><th class="noshow">Modify</th><th class="noshow">Delete</th></tr>';
    dataTable += '</thead>';
    // Setup the table body
    dataTable += '<tbody>';
    // Iterate over all vehicles in the array and put each in a row
    data.forEach((element) => {
        console.log(element.invId + ", " + element.invModel);
        dataTable += `<tr><td class="invDisplayName">${element.invMake} ${element.invModel}</td>`;
        dataTable += `<td class="invDisplayLink"><a href='/phpmotors/vehicles?action=mod&invId=${element.invId}' title='Click to modify'>Modify</a></td>`;
        dataTable += `<td class="invDisplayLink"><a href='/phpmotors/vehicles?action=del&invId=${element.invId}' title='Click to delete'>Delete</a></td></tr>`;
    });
    dataTable += '</tbody>';
    // Display the contents in the Vehicle Management view
    inventoryDisplay.innerHTML = dataTable;
}