              </div>
                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->
          <footer class="footer">
            <div class="container-fluid clearfix">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © <?php echo date('Y'); ?> <a href="#" target="_blank">POS SYSTEM</a>. All rights reserved.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Developed By <b>Developer Rijan</b><i class="far fa-heart"></i>
              </span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

  </div>
    <!-- plugins:js -->
    <!-- plugins:js -->
    
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    
    <!-- inject:js 'required off-canvas js for getting responsive menu in mobile'-->
    <script src="{{ asset('js/backend/js/shared/off-canvas.js') }}"></script>
    <!-- endinject -->


    <!-- Custom js for this page-->
    <script src="{{ asset('js/backend/js/dashboard-main/dashboard.js') }}"></script>
    <script src="{{ asset('js/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/backend/js/add-new-store.js') }}"></script>
    <script src="{{ asset('js/backend/js/top-search.js') }}"></script>
    <script src="{{ asset('js/backend/js/input-data.js') }}"></script>
    <script src="{{ asset('js/backend/js/store-edit.js') }}"></script>
    <script src="{{ asset('js/backend/js/output-data.js') }}"></script>
    <script src="{{ asset('js/backend/js/profile.js') }}"></script>    
    <script src="{{ asset('js/backend/js/worker-edit.js') }}"></script>
    
    
    
    <!--<script type="text/javascript">-->
    <!--    $(document).ready(function(){-->
    <!--        //get all stores
    <!--    	console.log('HI')-->
    <!--    	get_stores_all();-->
        	
    <!--    	function get_stores_all(){-->
    <!--    		$.ajax({-->
    <!--    			url: "/application/get/stores/all",-->
    <!--    			method: "GET",-->
    <!--    			dataType: 'JSON',-->
    <!--    			cache: false,-->
    <!--    			success: function(response){-->
    <!--    				$("#select_store_to_search").html(response)-->
    <!--    			},-->
    <!--    			error: function (jqXHR, textStatus, errorThrown) {-->
    <!--                    if (jqXHR.status === 500) {-->
    <!--                      	alert('Error to getting stores')-->
    <!--                    }else{                  	-->
    <!--                      	console.log('Something dangerous')-->
    <!--                    }-->
        
    <!--                }-->
    <!--            });-->
    <!--    	}-->
        
    <!--    })-->
    <!--</script>-->
    
    @stack('scripts')
    <!-- End custom js for this page-->
  </body>
</html>