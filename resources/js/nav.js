


// For Sidebar intergration.
var profilePicture = document.getElementById("ProfilePicture");
var closeButtons = document.getElementsByClassName("CloseButton");



// Opens sidebar 
function OpenSidebar()
{
    // Change this to check if there's a valid session ID or however we decide that the user is logged in.
    var userLoggedIn = true;

    var sidebars = document.getElementsByClassName('Sidebar');

    // If the user has been logged in then open up the sidebar bar with the account specfic options.
    if (userLoggedIn)
    {
        sidebars[0].style.width = "250px";
    }
    else
    {
        sidebars[1].style.width = "250px";
    }


}

// This function makes sure all sidebars are closed.
function CloseSidebar()
{
    // Just set width of Sidebars to zero.
    document.getElementById('LoggedInSidebar').style.width = "0px";
    document.getElementById('LoggedOutSidebar').style.width = "0px";
}


// Add event listeners
profilePicture.addEventListener('click', OpenSidebar);

Array.from(closeButtons).forEach(element => {
    element.addEventListener('click', CloseSidebar);
});