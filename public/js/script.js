for (var i = 0; i < document.links.length; i++) {
    if (document.links[i].href === document.URL) {
        document.links[i].className = 'nav-link active';
    }
}

const commentBtnList = document.querySelectorAll(".comment-btn");

function func(e) {
    e.preventDefault();
    console.log(e.currentTarget);
}

if (commentBtnList.length > 0) {
    for (let i = 0; i < commentBtnList.length; i++) {
        commentBtnList[i].addEventListener('click', e => {
            e.preventDefault();
            let element = e.currentTarget;
            let elementName = element.attributes.name.value;
            if (elementName === "delete") {
                let commentId = element.parentElement.attributes.id.value;
                const elementParent = document.getElementById("parentdiv" + commentId);
                deleteComment(commentId, elementParent);
            }
            if (elementName === "add") {
                addComment();
            }
            // if (elementName === "edit") {
            //     alert(elmentName);
            // }
        }, true);
    }
}

function deleteComment(id, nodItem) {
    $.ajax({
    type: "POST",
    url: "/gallery/deletecomment",
    data: { id: id },
    cache: false,
    success: function(responce){
         // console.log(responce);
         nodItem.remove();
        }
    });
}

function addComment() {
    const image = document.getElementById("selectedimage");
    let image_id = image.getAttribute('idindb');
    const commentDiv = document.getElementById("comment_text");
    let commentText = commentDiv.value;
    if (commentText.length < 5) {
        alert('Tou have to type at least 5 characters!');
        return;
    }
    let author_id = document.getElementById("author_id").value;
    let comment = {
        "image_id" : image_id,
        "commentText" : commentText,
        "author_id" : author_id
    };
    $.ajax({
        type: "POST",
        url: "/gallery/addcomment",
        data: { comment: comment },
        cache: false,
        success: function(response){
            // console.log(response);
            // document.getElementById('success').innerHTML = response;
            commentDiv.value = '';
            // let history = document.location;
            document.location.reload();
            // document.location = history;
        }
    });
    // showImage(image_id);
}


// function editComment(id) {
//     $.ajax({
//     type: "POST",
//     url: "/gallery/editcomment",
//     data: { id: id },
//     cache: false,
//     success: function(response){ console.log(response); }
//     });
// }

function showImage(image_id) {
    $.ajax({
        type: "POST",
        url: "/gallery",
        data: { image_id: image_id },
        cache: false,
        success: function(response){
            // console.log(response);
            document.getElementById('success').innerHTML = response;
        }

        // type: "GET",
        // url: "gallery/showimage",
        // data: {
        //     id: id
        // },
        // success: function (response) {
        //     document.getElementById('success').innerHTML = response;
        // }
    });
}




// function redirect(e) {
//     // e.currentTarget.style.visibility = 'hidden';
//     // e.preventDefault();
//     let image_id = e.currentTarget.getAttribute('id')
//     location.replace('/gallery/imageview');
//     alert(image_id);
// }


// carousel

// $('#recipeCarousel').carousel({
//     interval: 10000
//   })
  
//   $('.carousel .carousel-item').each(function(){
//       var minPerSlide = 3;
//       var next = $(this).next();
//       if (!next.length) {
//       next = $(this).siblings(':first');
//       }
//       next.children(':first-child').clone().appendTo($(this));
      
//       for (var i=0;i<minPerSlide;i++) {
//           next=next.next();
//           if (!next.length) {
//           next = $(this).siblings(':first');
//         }
          
//           next.children(':first-child').clone().appendTo($(this));
//         }
//   });



// var elements = document.querySelectorAll(".carousel-item");

// var observer = new MutationObserver(function(mutations) {
//   mutations.forEach(function(mutation) {
//     if (mutation.type == "attributes") {
//         return true;
//     //   console.log("attributes changed ");
//     }
//   });
// });

// elements.forEach (element => {

//     if (
//         observer.observe(element, {
//             attributes: true //configure it to listen to attribute changes
//         })
//     ) return console.log(element.getAttribute('id'));

// });