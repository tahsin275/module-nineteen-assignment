<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Post List</title>
    <!-- Tailwind CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

   
</head>

<body>
    <!-- Navbar -->
    <nav class="flex items-center justify-between flex-wrap bg-teal-500 p-6">
        <div class="flex items-center flex-shrink-0 text-white mr-6">
            <span class="font-semibold text-xl tracking-tight">Blog Site</span>
        </div>
        <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
            <div class="text-sm lg:flex-grow">
                <a href="#responsive-header"
                    class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
                    Home
                </a>
                <a href="#responsive-header"
                    class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
                    About
                </a>
                <a href="#responsive-header" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white">
                    Contact
                </a>
            </div>
        </div>
    </nav>
    <!-- Blog Posts -->
    <div  class="flex flex-col items-center p-6" id="bloglist">


        



    </div>

 

</body>

<script>
    getAllpost();
   
    async function getAllpost() {
        try{
            let response = await axios.get('/blogposts');
            response.data.forEach(item=>{
                document.getElementById('bloglist').innerHTML +=
                (
                    `
                    <div id ="${item['id']}" class="card-item w-full sm:w-2/3 md:w-2/2 lg:w-2/3 xl:w-2/4">
                        <div class="rounded overflow-hidden shadow-lg m-3 flex">
                            <img class="w-1/2"
                                src='${item['image_url']}'
                                alt="Sunset in the mountains">
                            <div class="px-6 py-4 w-1/2">
                                <div class="font-bold text-xl mb-2">${item['title']}</div>
                                <p class="text-gray-700 text-base">
                                    ${item['content']}
                                </p>
                            </div>
                        </div>
                    </div>
                    `
                )
            });

            // After rendering the cards, add event listeners to them
            addEventListeners();

        } catch(e){
            alert(e);
        }
    }

    function addEventListeners() {
        // Get all card items
        const cardItems = document.getElementsByClassName('card-item');

        // Add event listener to each card
        for (let i = 0; i < cardItems.length; i++) {
            cardItems[i].addEventListener('click', function(e) {
                // Get the id of the card that was clicked
                const id = e.currentTarget.id;

                 // Redirect to another page
                 window.location.href = "{{ url('/blogposts/') }}" + "/" + id;
               
                // Here you can do whatever you want with the id
              //  alert(`Card with id ${id} was clicked!`);
                
            });
        }
    }
</script>


</html>
