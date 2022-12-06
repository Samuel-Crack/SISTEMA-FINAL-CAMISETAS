<section class="content">

      <!-- Default box -->
      <form action="?ctrl=CtrlCarrito&accion=agregar&url=detalles" method="post">
      <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none">LOWA Men’s Renegade GTX Mid Hiking Boots Review</h3>
              <div class="col-12">
                <?php 
                    $imagen= (is_array($imagenes['data']))?$imagenes['data'][0]['url']:'SIN_IMAGEN.jpg' ;
                ?>
                <img src="recursos/images/catalogo/<?=$imagen?>" class="product-image" alt="Product Image">
              </div>
              
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3"><?=$data[0]['seleccion']?></h3>
                <p><?=$data[0]['descripcion']?>
                </p>
                
              <hr>
              <h4>Calidad: <?=$data[0]['calidad']?></h4>
              <h4>Modelo: <?=$data[0]['modelo']?></h4>
              <hr>
                  
              <h4 class="mt-3">Camisetas <small>Por favor seleccione uno</small></h4>
              <div class="col-12 product-image-thumbs">
                <?php 
                    $idImg=null;
                    if(is_array($imagenes['data']))
                    foreach ($imagenes['data'] as $img) { 
                      if (is_null($idImg)) 
                        $idImg=$img['url'];
                      ?>
                    <div class="product-image-thumb active">
                      <img src="recursos/images/catalogo/<?=$img['url']?>" alt="Product Image" class="imagenes" data-id="<?=$img['url']?>">                      
                    </div>           
                <?php 
                    }
                ?> 
                   
             </div>
             <br>
                  <input type="hidden" name="img" id="imgSeleccionada" value="<?=$idImg?>">
                  <input type="hidden" name="id"  value="<?=$data[0]['iddetalles_camisetas']?>">




                  <!-- Eliminar Imagenes 

             <tr>
          
                <hr>
                <img src="recursos/images/catalogo/<?=$img?>"  class="imagenes" data-id="<?=$img['url']?>">
                <a href="?ctrl=CtrlCarrito&accion=sacar&url=detalles=<?=$img['url']?>" class="btn btn-danger">Eliminar</a>  
                                         
                
                </td>
            </tr>
            
              -->

             <!-- Button trigger modal 

            <a class="btn btn-success" href="modal-agregar" class="text-center" role="button" data-toggle="modal" data-target="#modal-agregar" title="">Agregar Imagenes</a>

            -->

            <!-- Ventana Modal 

            <div class="modal fade" id="modal-agregar">
              <div class="modal-dialog">
                  <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">IMG</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
                  </div>

                  <div class="modal-body">
                      <p class="login-box-msg">Agregue IMG</p>


                      <form action="?ctrl=CtrlCarrito&accion=agregar&url=detalles"  class="row g-3 mt3" method="post">
                          <div class="col-6">
                            <label for="url" class="form-label">Url:</label>
                          <input type="text" name="url" class="form-control" id="url" placeholder="url" value="<?=$data[0]['url']?>" required="true">
                          <div class="input-group-append"></div>
                        </div>
                        </div>
                  <div class="modal-footer">
                          <button type="submit" class="btn btn-primary">Agregar Img</button>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                      </form>
                    

              Tallas -->

            

             <h4 class="mt-3">Talla <small>Selecciona una</small></h4>
              <div class="btn-group btn-group-toggle" data-toggle="buttons">
              <?php 
                $checked='checked';
                if(is_array($tallas['data']))
                    foreach ($tallas['data'] as $t) { 
                      ?> 

                <label class="btn btn-primary text-center">
                  <input type="radio" <?=$checked?> name="talla" value="<?=$t['talla']?>">
                  <span class="text-xl"><?=$t['talla']?></span>
                  
            
                </label>
              <?php 
                  if ($checked=='checked') 
                    $checked='';
                } ?>
              </div> 

              <div class="row">
                <div class="col-md-6">
                    <div class="bg-gray py-2 px-3 mt-4">
                        <h2 class="mb-0">
                        S/ <?=number_format($data[0]['precio'], 2, ',', ' ')?>
                        </h2>
                        <h4 class="mt-0">
                        <small>Aprovecha </small>
                        </h4>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bg-gray py-2 px-3 mt-4">
                        <h2 class="mb-0">
                          <?= $data[0]['stock']?> Unidades disponibles
                        </h2>
                        
                    </div>
                </div>
              </div>

              <div class="mt-4">
                <input type="submit" class="btn btn-primary btn-lg btn-flat" value="Agregar al carrito">
                
                <a href="?ctrl=CtrlCarrito&accion=mostrar" class="btn btn-primary btn-lg btn-flat">
                  <i class="fas fa-cart-plus fa-lg mr-2"></i>
                  Ir al carrito
                </a>
            
              </div>

              <div class="mt-4 product-share">
                <a href="#" class="text-gray">
                  <i class="fab fa-facebook-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fab fa-twitter-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fas fa-envelope-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fas fa-rss-square fa-2x"></i>
                </a>
              </div>

            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
      </form>
    </section>
    <!-- /.content -->
    