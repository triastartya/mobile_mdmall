<script>
    app.controller("myCtrl", function($scope,$http) {

    
        var $dp_start = $('#uk_dp_start'),
            $dp_end = $('#uk_dp_end');

        var start_date = UIkit.datepicker($dp_start, {
            format:'YYYY-MM-DD'
        });

        var end_date = UIkit.datepicker($dp_end, {
            format:'YYYY-MM-DD'
        });
        
        $scope.startdate = date_now();
        $scope.enddate = date_now();
        
        $('#uk_dp_start').val($scope.startdate)
        $('#uk_dp_end').val($scope.enddate)

        $dp_start.on('change',function() {
            end_date.options.minDate = $dp_start.val();
            setTimeout(function() {
                $dp_end.focus();
            },300);
        });

        $dp_end.on('change',function() {
            start_date.options.maxDate = $dp_end.val();
        });




        $scope.title = "Sembako";
        $scope.tanggal = date_now();
        $scope.data = [];


        const modal = UIkit.modal("#modal_tanggal");
        const modal_barang = UIkit.modal("#modal_barang");
        modal.on({
            'hide.uk.modal': function(){
                //console.log($('#uk_dp_start').val());
                $scope.startdate = $('#uk_dp_start').val();
                //console.log($('#uk_dp_end').val());
                $scope.enddate = $('#uk_dp_end').val()
                $scope.get_data();
                $scope.$apply();

            }
        });


        $('#tanggal').on('change',function(){
            $scope.tanggal = $('#tanggal').val()
            $scope.get_data();
            
        })

        $scope.total_lokasi = 0 ;
        
        $scope.get_data = function(){
            Swal.fire({title: 'Loading..',onOpen: () => {Swal.showLoading()}})
            $http.post("{{ url('api/mob/get_sembako_lokasi') }}",{
                tanggal_mulai : $scope.startdate,
                tanggal_sampai : $scope.enddate 
            }).then(function(res){
                if(res.data.status){
                    $scope.data = res.data.data
                    $scope.total_lokasi = res.data.data.sum('total');
                    Swal.close();
                }else{
                    Swal.fire({icon: 'error',title: 'Oops...',text: res.data.message,})
                }
            });
        }

        $scope.get_data();

        $scope.filter = function(){
            modal.show();
        }
        $scope.barang = [];
        $scope.lokasi = '';
        $scope.handleClickLokasi = function(x){
            console.log(x);
            Swal.fire({title: 'Loading..',onOpen: () => {Swal.showLoading()}})
            $http.post("{{ url('api/mob/get_sembako') }}",{
                tanggal_mulai   : $scope.startdate,
                tanggal_sampai  : $scope.enddate,
                IdLokasi        : x.IdLokasi
            }).then(function(res){
                if(res.data.status){
                    Swal.close();
                    modal_barang.show();
                    $scope.barang = res.data.data
                    $scope.lokasi = x.Lokasi
                    $scope.$apply();
                }else{
                    Swal.fire({icon: 'error',title: 'Oops...',text: res.data.message,})
                }
            });
        }

        

    });
</script>