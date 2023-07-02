<script>
    app.controller("myCtrl", function($scope,$http) {
        $scope.title = "Kasir";
        $scope.tanggal = date_now();
        $scope.data = [];
        $('#tanggal').val($scope.tanggal)

        $('#tanggal').on('change',function(){
            $scope.tanggal = $('#tanggal').val()
            $scope.get_data();
            
        })
        
        const modal_barang = UIkit.modal("#modal_barang");
        
        $scope.get_data = function(){
            Swal.fire({title: 'Loading..',onOpen: () => {Swal.showLoading()}})
            $http.post("{{ url('api/mob/get_croscek') }}",{
                tanggal : $scope.tanggal 
            }).then(function(res){
                if(res.data.status){
                    $scope.data = res.data.data
                    Swal.close();
                }else{
                    Swal.fire({icon: 'error',title: 'Oops...',text: res.data.message,})
                }
            });
        }
        
        $scope.detail = null;
        $scope.handleClickLokasi = function(x){
            console.log(x);
            $scope.detail = x;
            modal_barang.show();
        }

        $scope.get_data();

        

    });
</script>