
CheckForGallery();

// Checks if the page actually has the image gallery loaded on the page.
function CheckForGallery()
{
    // Wait until id tag is made in html.
    var sectionTags = document.getElementsByTagName("section");

    for(var section of sectionTags)
    {
        console.log(`Section ID: ${section.id}`);
        
        if (section.id == "ImageGallery")
        {
            startImageGallery();
            console.log("ID EQUALS ImageGallery")
            break;
        }
    }

}

// Given that we know that the page actually has an image gallery (since this function was called.) we can set up the image gallery.
function startImageGallery()
{
    var currentImage = 0; // The current image that is being displayed on the web page.

    // Reference to Image
    var imageLocation = document.getElementById("image1");

    // Changes image to the next image in the list (And loops back at the end of the list).
    function changeImage()
    {
        currentImage++;

        if(currentImage >= 6)
        {
            currentImage = 1;
        }

        // Change Image
        imageLocation.src = `images/ImageGallery${currentImage}.jpg`;
        
        console.log(imageLocation.src);
        // Calls itself after 5 seconds for infinite loop.
        setTimeout(changeImage, 5000);
    }

    changeImage();
}



// Forces image gallery to be a certain image. (Maybe hook this up to radio buttons on the image gallery)
function changeImageDirectly()
{

}

