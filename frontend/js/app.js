
const app = document.getElementById("app");

function showPage(page) {

    if (page === "home") {
        app.innerHTML = `
            <section id="home">
                <h2>Welcome to Ace Tennis Academy</h2>
                <p>Manage your tennis training sessions, coaches and bookings in one place.</p>

                <div>
                    <button onclick="location.hash='trainings'">
                        Explore Trainings
                    </button>

                    <button onclick="location.hash='register'">
                        Join Academy
                    </button>
                </div>
            </section>
        `;
    }

    
    else if (page === "coaches") {
        fetch("views/coaches.html")
            .then(response => {
                if (!response.ok) {
                    throw new Error("Coaches page could not be loaded");
                }

                return response.text();
            })
            .then(html => {
                app.innerHTML = html;
            })
            .catch(error => {
                console.error(error);
                app.textContent = "Unable to load coaches.";
            });
    }


    
    else if (page === "trainings") {
        fetch("views/trainings.html")
            .then(response => {
                if (!response.ok) {
                    throw new Error("Trainings page could not be loaded");
                }

                return response.text();
            })
            .then(html => {
                app.innerHTML = html;
            })
            .catch(error => {
                console.error(error);
                app.textContent = "Unable to load trainings.";
            });
    }


    else if (page === "login") {
    fetch("views/login.html")
        .then(response => {
            if (!response.ok) {
                throw new Error("Login page could not be loaded");
            }
            return response.text();
        })
        .then(html => {
            app.innerHTML = html;
        })
        .catch(error => {
            console.error(error);
            app.textContent = "Unable to load the login page.";
        });
    }

    
    else if (page === "register") {
        fetch("views/register.html")
            .then(response => {
                if (!response.ok) {
                    throw new Error("Register page could not be loaded");
                }
                return response.text();
            })
            .then(html => {
                app.innerHTML = html;
            })
            .catch(error => {
                console.error(error);
                app.textContent = "Unable to load the register page.";
            }
        );
    }

    
    else if (page === "dashboard") {
        fetch("views/dashboard.html")
            .then(response => {
                if (!response.ok) {
                    throw new Error("Dashboard could not be loaded");
                }

                return response.text();
            })
            .then(html => {
                app.innerHTML = html;
            })
            .catch(error => {
                console.error(error);
                app.textContent = "Unable to load dashboard.";
            }
        );
    }


    else if (page === "courts") {
        fetch("views/courts.html")
            .then(response => {
                if (!response.ok) {
                    throw new Error("Courts page could not be loaded");
                }

                return response.text();
            })
            .then(html => {
                app.innerHTML = html;
            })
            .catch(error => {
                console.error(error);
                app.textContent = "Unable to load courts.";
            });
    }

    
    else if (page === "bookings") {
        fetch("views/bookings.html")
            .then(response => {
                if (!response.ok) {
                    throw new Error("Bookings page could not be loaded");
                }

                return response.text();
            })
            .then(html => {
                app.innerHTML = html;
            })
            .catch(error => {
                console.error(error);
                app.textContent = "Unable to load bookings.";
            });
    }

    
    else if (page === "profile") {
        fetch("views/profile.html")
            .then(response => {
                if (!response.ok) {
                    throw new Error("Profile page could not be loaded");
                }

                return response.text();
            })
            .then(html => {
                app.innerHTML = html;
            })
            .catch(error => {
                console.error(error);
                app.textContent = "Unable to load profile.";
            });
    }

    
    else if (page === "admin") {
        fetch("views/admin.html")
            .then(response => {
                if (!response.ok) {
                    throw new Error("Admin page could not be loaded");
                }

                return response.text();
            })
            .then(html => {
                app.innerHTML = html;
            })
            .catch(error => {
                console.error(error);
                app.textContent = "Unable to load admin panel.";
            });
    }



    else {
        app.innerHTML = `
            <section class="content-page">
                <h2>Page Coming Soon</h2>
                <p>We are working on this page.</p>
            </section>
        `;
    } 

    

}

function loadPage() {
    const page = window.location.hash.substring(1) || "home";
    showPage(page);
}

window.addEventListener("hashchange", loadPage);

loadPage();


document.addEventListener("submit", function(event) {
    if (
        event.target.id === "loginForm" ||
        event.target.id === "registerForm"
    ) {
        event.preventDefault();
        alert("This feature will be available soon!");
    }
});



document.addEventListener("click", function(event) {
    const button = event.target.closest(".book-btn");

    if (button) {
        const trainingName = button.dataset.training;

        alert(
            "You selected: " + trainingName +
            "\nBooking functionality will be available soon!"
        );
    }
});



document.addEventListener("click", function(event) {

    if (event.target.classList.contains("cancel-btn")) {

        const button = event.target;

        const confirmCancel = confirm(
            "Are you sure you want to cancel this booking?"
        );

        if (confirmCancel) {

            const row = button.closest("tr");

            const status = row.querySelector(".booking-status");

            status.textContent = "Cancelled";
            status.classList.remove("confirmed");
            status.classList.add("cancelled");

            button.textContent = "Cancelled";
            button.disabled = true;

            alert("Booking cancelled successfully!");
        }
    }
});


document.addEventListener("submit", function(event) {

    if (event.target.id === "profileForm") {

        event.preventDefault();

        const name = document.getElementById("profileName").value;

        alert("Profile changes saved for " + name + " (demo only).");
    }

});


document.addEventListener("submit", function(event) {

    if (event.target.id === "addCoachForm") {

        event.preventDefault();

        const name = document.getElementById("coachName").value.trim();
        const specialty = document.getElementById("coachSpecialty").value;

        if (name === "" || specialty === "") {
            alert("Please fill in all fields.");
            return;
        }

        const tableBody = document.getElementById("adminCoachesList");

        const newRow = document.createElement("tr");

        const nameCell = document.createElement("td");
        nameCell.textContent = name;

        const specialtyCell = document.createElement("td");
        specialtyCell.textContent = specialty;

        const actionCell = document.createElement("td");

        const deleteButton = document.createElement("button");
        deleteButton.type = "button";
        deleteButton.className = "admin-delete-btn";
        deleteButton.textContent = "Delete";

        actionCell.appendChild(deleteButton);

        newRow.appendChild(nameCell);
        newRow.appendChild(specialtyCell);
        newRow.appendChild(actionCell);

        tableBody.appendChild(newRow);

        event.target.reset();

        alert("Coach added successfully! (Demo only)");
    }

});


document.addEventListener("click", function(event) {

    if (event.target.classList.contains("admin-delete-btn")) {

        const confirmDelete = confirm(
            "Are you sure you want to delete this coach?"
        );

        if (confirmDelete) {
            const row = event.target.closest("tr");
            row.remove();
        }
    }

});
