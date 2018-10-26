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

        /**
         * @desc get all products via ajax
         */
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
                                        <button data-toggle="modal" data-target="#modal" class="update btn btn-info" data-id="${item.id}" data-name="${item.nom}" data-price="${item.prix}" data-category="${item.categorie}">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </button>
                                    </td>
                                </tr>`
                            );
              });

          });
       }
        //Add new product && update product by using bootstrap modal
        $('input[type=submit]').on('click',function(e){

            if($(this).val() == 'Valider'){
                //Add product
                $.post('ajout.php',
                {
                name :     $('#name').val(),
                price:     $('#price').val(),
                category:  $('#category').val()
                },
                function(data){
                    $('#modal').modal('toggle');
                    removeAlert('h2','Un nouveau plat a été ajouté!');
                    getProduct();
                });
            }

            else if($(this).val() == 'Modifier'){
                //Update product
                var id = $('input[type=hidden]').val();
                var name = $('#name').val();
                var price = $('#price').val();
                var category = $('#category').val();

                $.post('modifier.php',
                {
                id :       id,
                name :     name,
                price:     price,
                category:  category
                },
                function(data){
                    $('#modal').modal('toggle');
                    removeAlert('h2','Le plat a été modifié"!');
                    getProduct();
                });
            }
        });

        //reset modal form values in order to add new product
        $('body').on('click','#add',function(e){

            $('#name').val('');
            $('#price').val('');
            $('#category').val('');

            $('#modalLabel').text('Ajouter un plat');
            $('.modal-footer input[type=submit]').val('Valider');
        });

        //add values on form modal in order to update an existing product
        $('body').on('click','.update',function(e){
            $('input[type=hidden]').attr('value',$(this).attr('data-id'));
            $('#name').val($(this).attr('data-name'));
            $('#price').val($(this).attr('data-price'));
            $('#category').val($(this).attr('data-category'));

            $('#modalLabel').text('Modifier le plat');
            $('.modal-footer input[type=submit]').val('Modifier');
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
