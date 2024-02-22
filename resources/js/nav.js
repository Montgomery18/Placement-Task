


CheckForSidebar();


function CheckForSidebar()
{
    var headers = document.getElementsByTagName('header');
    console.log("THIS IS: nav.js:")
    console.log(headers[0]);

    if (headers[0].classList.contains('MainHeader'))
    {
        addSidebarToButtons();
    }
}

function IsUserLoggedIn()
{
    console.log("This is Login ID: " + window.accountID);

    if (window.accountID == null)
    {
        return false;
    }
    else
    {
        return true;
    }
}

// Opens sidebar 
function OpenSidebar()
{
    // Checks the current sessionID to see if a user has been logged in.
    var userLoggedIn = IsUserLoggedIn();

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


// To prevent crashes on pages without these IDs. This function should only be called when we know the loaded pages actually have these elements. 
function addSidebarToButtons()
{
    // For Sidebar intergration.
    var profilePicture = document.getElementById("ProfilePicture");
    var closeButtons = document.getElementsByClassName("CloseButton");

    // Add event listeners
    profilePicture.addEventListener('click', OpenSidebar);

    Array.from(closeButtons).forEach(element => {
        element.addEventListener('click', CloseSidebar);
    });

    console.log("ADDED SIDEBAR TO BUTTONS");
}