  $(document).on('change','.area_changed',function(){
           var areaId = document.querySelector('.area_changed').value ;

           if(parseInt(areaId))
           {
               $('.seller_select').removeAttr('disabled');
               $.ajax({
                   type: 'POST',
                   url: "/admin/getSellerForThisArea/"+areaId,
                   data: {
                       '_token':"{{csrf_token()}}",
                   },
                   success: function (data) {

                          if(data.NoSellers)
                          {
                              // show the sellers
                                  // $('.seller_select').append(`<option  value="${seller.id}">${seller.name}</option>`)
                              $('.seller_select').empty().prepend(` <option value="0">Seller Name </option>`)
                              // var datas = "<table class='show_data_table' style='display: none'>  <tr> <th> id  </th>  <th> barcodeNumber  </th> </tr>";
                              for (var key in data.sellers)
                              {
                                //   console.log('here')
                                //   var row = `<tr> <td> ${data.sellers[key].id} </td> <td>${data.sellers[key].name}</td> </tr>`;
                                // datas.concat(row)
                                  $('.seller_select').append(`<option  value="${data.sellers[key].id}">${data.sellers[key].name}</option>`)
                                  // console.log('hrer ehere')
                              }
                              // datas.concat(' </table>')

                              $('.seller_select').removeAttr('disabled');
                              $('.seller_select option[value="-1"]').remove();


                          }
                          else
                              {
                                  $('.form_data').slideUp();
                              $('.seller_select').attr('disabled','disabled').prepend('<option value="-1" selected>No Sellers In This Area</option>');
                          }

                   }, error: function (reject) {


                   }
               });
           }
           else{
               $('.form_data').slideUp();
               $('.seller_select option[value="0"]').attr('selected','selected');
               $('.seller_select option[value="-1"]').remove();
               $('.seller_select').attr('disabled','disabled');
           }
            $('.show_products_btn').attr('disabled','disabled');
            $('.number_of_products_in_this_area_to_this_seller').val(0)
        });
        $(document).on('change','.seller_select',function(){
            var table = $('#sample_2').DataTable();

//clear datatable
            table.clear().draw();
            // $('.form_data').slideUp();
            var seller_id = document.querySelector('.seller_select').value ;
            var areaId = document.querySelector('.area_changed').value
            $('.body_for_products').empty() ;

            if(parseInt(seller_id))
            {
                $.ajax({
                    type: 'POST',
                    url: "/admin/getProductsForSellerInThisArea/"+areaId+"/"+seller_id,
                    data: {
                        '_token':"{{csrf_token()}}",
                    },
                    success: function (data) {

                            if(data.NoProductsInThisArea)
                            {

                                // <th class="text-center"> Client Name </th>
                                // <th class="text-center"> Tracking Number </th>
                                // <th class="text-center"> Price </th>
                                // <th class="text-center"> Address </th>


                                $('.body_for_products').empty() ;
                                for (var key in data.productsInThisArea)
                                {

                                    var table = $('#sample_2').DataTable();

                                    table.row.add([
                                        `${parseInt(key)+1}`,
                                        `${data.productsInThisArea[key].client_name}`,
                                        `${data.productsInThisArea[key].barcode_number}`,
                                        `${data.productsInThisArea[key].price} EGP`,
                                       `${data.productsInThisArea[key].address}`,

                                    ]).draw(false);

//                                     $('.body_for_products').append(`<tr>
// <td class="text-center">${data.productsInThisArea[key].client_name}
// </td>
// <td class="text-center">${data.productsInThisArea[key].barcode_number}
// </td>
// <td class="text-center">${data.productsInThisArea[key].price} EGP
// </td>
// <td class="text-center">${data.productsInThisArea[key].address}
// </td>
//
// <tr>`)

                                }

                                $('.number_of_products_in_this_area_to_this_seller').val(data.NoProductsInThisArea)
                                $('.show_products_btn').removeAttr('disabled');
                            }
                            else
                            {
                                $('.form_data').slideUp();
                                $('.show_products_btn').attr('disabled','disabled');
                                $('.number_of_products_in_this_area_to_this_seller').val(0)
                            }


                    }, error: function (reject) {


                    }
                });

            }
            else{
                $('.form_data').slideUp();
                $('.number_of_products_in_this_area_to_this_seller').val(0);
                $('.show_products_btn').attr('disabled','disabled');
            }
        });
        $(document).on('click','.show_products_btn',function(e){
            e.preventDefault();
            $('.form_data').slideDown();
        })
