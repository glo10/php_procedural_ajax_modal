(function(){
    $(document).ready(function(){
        getProduct();
        /**
        *@desc remove user message after 2sec
        *@param afterEl string html element
        *@param msg string message
        */
        function removeAlert(afterEl,msg){
          $(afterEl).after('<p class="alert alert-success">'+ msg +'</p>');
          setTimeout(function(){
            $(afterEl).next().remove();
          },3000);
        }

        //Get all products
       function getProduct(){
        $('tbody').empty();
         $.get('liste.php',
          function(data){
              var myData = JSON.parse(data);
              $.each(myData,function(i,item){
                $('tbody').append(
                                `<tr>
                                    <td>${item.id}</td>
                                    <td>${item.nom}</td>
                                    <td>${item.prix}</td>
                                    <td>${item.categorie}</td>
                                    <td>
                                        <button data-id="${item.id}" class="delete btn btn-danger">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                    </td>
                                    <td>
                                        <a class="btn btn-warning" href="modifierForm.php?id=${item.id}">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </a>
                                    </td>
                                </tr>`
                            );
              });
              
          });
       }
        //Add new product
        $('input[type=submit]').on('click',function(e){
            $.post('ajout.php',
            {
            name :     $('#name').val(),
            price:     $('#price').val(),
            category:  $('#category').val()
            },
            function(data){
              console.log(data);
                $('#modal').modal('toggle');
                removeAlert('h2','Un nouveau plat a été ajouté!');
                getProduct();
            });
        });
        //Erase product
        $('body').on('click','.delete',function(e){
            $.post('supprimer.php',
            {
            id : $(this).attr('data-id')
            },
            function(data){
                removeAlert('h2','Un plat a été supprimé!');
                getProduct();
            });
        });
    });
})();