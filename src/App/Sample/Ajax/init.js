window.addEventListener("DOMContentLoaded", function (e) { // when the page loads
    document.querySelector("#vanillacountry").addEventListener("keyup", function (e) { // when keyup
        fetch("http://localhost/functions.php", { // fetch the file
            method: "POST", // POST method
            headers: {"Content-Type": "application/x-www-form-urlencoded"}, // set the content type
            body: "search=" + this.value // value of the input
        }).then(function (response) { // when the response is returned
            return response.text(); // return the response
        }).then(function (response) { // when the response is returned
            var countryList = document.querySelector(".country-list"); // get the country list
            countryList.innerHTML = ""; // remove all child nodes of the div
            countryList.style.display = "block"; // show the div
            JSON.parse(response).forEach(function (item) { // loop though the response
                var li = document.createElement("li"); // create a list item
                li.innerHTML = item; // set the text of the list item
                countryList.appendChild(li); // append the list item to the div
            });
        });
    });
});

document.querySelector(".country-list").addEventListener("click", function (e) { // when a list item is clicked
    if (e.target.tagName === "LI") { // if the clicked item is a list item
        selectCountry(e.target.innerHTML, e.target); // call the function to select the item
    }
});

function selectCountry(val, el) { // function to select the item
    document.querySelector("#vanillacountry").value = val; // set the value of the input to the value of the clicked item
    el.style.display = "none"; // hide the div
}