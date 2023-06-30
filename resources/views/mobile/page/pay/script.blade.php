<script type="text/javascript"
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="SB-Mid-client-PFNIxJOJpYlDXGrW">
</script>

<script>
    app.controller("myCtrl", function($scope,$http) {
        $scope.invoice_number = '000004';
        
        $scope.changeResult = function(type, data){
            console.log('type',type);
            console.log('data',data);
            if (type == "success" || type == "pending") {
                $http.post(API.base_url + '/callback',data).then(function(res){
                    console.log(res);
                });
            } else {
                alert("Maaf Transaksi Gagal Silahkan Ulangi Kembali");
            }
        }
        
        $scope.pay = function(){
            var snaptoken = "";
            $.ajax({
                type: "POST",
                url: 'http://127.0.0.1:8000/api/midtrans/getSnap',
                data : {
                    "invoice_number" : $scope.invoice_number
                    "payment_method" : 'transfer'
                    },
                cache: false,
                crossDomain: true,
                success: function (data) {
                    snaptoken = data.token;
                    snap.pay(snaptoken, // pop up midtrans / dialog modal
                    { // callback pop up 
                        onSuccess: function (result) { 
                            $scope.changeResult('success', result);
                            //direct
                        },
                        onPending: function (result) {
                            $scope.changeResult('pending', result);
                            //direct
                        },
                        onError: function (result) {
                            $scope.changeResult('error', result);
                            //direct
                        }
                    });
                },
                error: function (data) {
                    alert('gagal');
                }
            });
        }

    });
</script>