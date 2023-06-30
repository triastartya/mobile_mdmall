<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Lokasi;
use App\Models\TransSaldoKasirHeader;
use App\Models\TransSaldoKasirDetailTambahanModal;
use App\Models\TransSaldoKasirDetailRekapSistem;
use App\Models\TransSembakoHeader;
use App\Models\TransSembakoDetailBarang;
use App\Models\logErrorSend;
class TransSaldoKasir extends Controller
{
    //
    public function insert(Request $request){
        // dd($request);
        try{
            $cek = TransSaldoKasirHeader::where('IdLokasi',$request->idLokasi)
            ->where('SaldoKasirID',$request->saldoKasirID)->first();
            if($cek){
                throw new \Exception('data croscek sudah ada');
            }
            DB::beginTransaction();
            // TRANSAKSI HEADER
                $TransSaldoKasirHeader = new TransSaldoKasirHeader;
                $TransSaldoKasirHeader->TransID                 = $request->saldoKasirID.'-'.$request->idLokasi;
                $TransSaldoKasirHeader->IdLokasi                = $request->idLokasi;
                $TransSaldoKasirHeader->SaldoKasirID            = $request->saldoKasirID;
                $TransSaldoKasirHeader->FakturSaldoKasir        = $request->fakturSaldoKasir;
                $TransSaldoKasirHeader->UserKasir               = $request->userKasir;
                $TransSaldoKasirHeader->WaktuBukaKasir          = $request->waktuBukaKasir;
                $TransSaldoKasirHeader->WaktuTutupKasir         = $request->waktuTutupKasir;
                $TransSaldoKasirHeader->KeteranganTutupKasir    = $request->keteranganTutupKasir;
                $TransSaldoKasirHeader->UserValidasiSpvToko     = $request->userValidasiSpvToko;
                $TransSaldoKasirHeader->WaktuValidasiSpvToko    = $request->waktuValidasiSpvToko;
                $TransSaldoKasirHeader->KeteranganValidasiSpvToko = $request->keteranganValidasiSpvToko;
                $TransSaldoKasirHeader->JumlahModalAwal         = $request->jumlahModalAwal;
                $TransSaldoKasirHeader->JumlahPenerimaanVerSistem = $request->jumlahPenerimaanVerSistem;
                $TransSaldoKasirHeader->JumlahPenerimaanVerUser = $request->jumlahPenerimaanVerUser;
                $TransSaldoKasirHeader->IsMatch                 = $request->isMatch;
                $TransSaldoKasirHeader->StatusSaldo             = $request->statusSaldo;
                $TransSaldoKasirHeader->JumlahStoranBank        = $request->jumlahStoranBank;
                $TransSaldoKasirHeader->save();
            // TRANSAKSI DETAIL
            // dd($request);
                foreach($request->transSaldoKasirDetailTambahanModal as $TransSaldoKasirDetailTambahanModal_data){
                    $TransSaldoKasirDetailTambahanModal = new TransSaldoKasirDetailTambahanModal;
                    $TransSaldoKasirDetailTambahanModal->TransID      = $request->saldoKasirID.'-'.$request->idLokasi;
                    $TransSaldoKasirDetailTambahanModal->SaldoKasirID = $request->saldoKasirID;
                    $TransSaldoKasirDetailTambahanModal->TambahanModal= $TransSaldoKasirDetailTambahanModal_data['tambahanModal'];
                    $TransSaldoKasirDetailTambahanModal->save();
                } 

                foreach($request->transSaldoKasirDetailRekapSistem as $TransSaldoKasirDetailRekapSistem_data){
                    $TransSaldoKasirDetailRekapSistem = new TransSaldoKasirDetailRekapSistem;
                    $TransSaldoKasirDetailRekapSistem->TransID      = $request->saldoKasirID.'-'.$request->idLokasi;
                    $TransSaldoKasirDetailRekapSistem->SaldoKasirID = $request->saldoKasirID;
                    $TransSaldoKasirDetailRekapSistem->SalesPaymentMethod = $TransSaldoKasirDetailRekapSistem_data['salesPaymentMethod'];
                    $TransSaldoKasirDetailRekapSistem->JumlahPenerimaan = $TransSaldoKasirDetailRekapSistem_data['jumlahPenerimaan'];
                    $TransSaldoKasirDetailRekapSistem->Keterangan = $TransSaldoKasirDetailRekapSistem_data['keterangan'];
                    $TransSaldoKasirDetailRekapSistem->save();
                }

            // TRANSAKSI SEMBAKO 
                $TransSembakoHeader = new TransSembakoHeader;
                $TransSembakoHeader->TransID  = $request->saldoKasirID.'-'.$request->idLokasi;
                $TransSembakoHeader->KodeReff = $request->saldoKasirID;
                $TransSembakoHeader->Tanggal  = $request->waktuTutupKasir;
                $TransSembakoHeader->IdLokasi = $request->idLokasi;
                $TransSembakoHeader->save();
                $TransSembakoID = $TransSembakoHeader->id;
            
            // TRANSAKSI DETAIL SEMBAKO 
            foreach($request->transSembakoDetailBarang as $TransSembakoDetailBarang_data){
                $TransSembakoDetailBarang = new TransSembakoDetailBarang;
                $TransSembakoDetailBarang->TransID        = $request->saldoKasirID.'-'.$request->idLokasi;
                $TransSembakoDetailBarang->TransSembakoID = $TransSembakoID;
                $TransSembakoDetailBarang->KodeBarang = $TransSembakoDetailBarang_data['kodeBarang'];
                $TransSembakoDetailBarang->NamaBarang = $TransSembakoDetailBarang_data['namaBarang'];
                $TransSembakoDetailBarang->QtyJual = $TransSembakoDetailBarang_data['qtyJual'];
                $TransSembakoDetailBarang->Satuan = $TransSembakoDetailBarang_data['satuan'];
                $TransSembakoDetailBarang->Nominal = $TransSembakoDetailBarang_data['nominal'];
                $TransSembakoDetailBarang->save();
            }
            DB::commit();
            return response()->json(['status'=>true,'message'=>'data berhasil di simpan']);
        } catch (\Exception $ex) {
            DB::rollback();
            $error = new logErrorSend;
            $error->message = $ex->getMessage();
            $error->data = json_encode($request->all());
            $error->ex = $ex;
            $error->save();
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
        
    }
    
    public function TransSaldoKasir_tes(Request $request){
        dd($request);
    }

    public function get_croscek(Request $request){
        try{
            $data = TransSaldoKasirHeader::with("Lokasi",'TransSaldoKasirDetailTambahanModal','TransSaldoKasirDetailRekapSistem')
            ->whereDate('WaktuTutupKasir',$request->tanggal)->get();
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }

    public function get_sembako(Request $request){
        try{
            // $data = TransSembakoDetailBarang::select(
            // \DB::raw(
            // 'transsembakodetailbarang.KodeBarang,
            // transsembakodetailbarang.NamaBarang,
            // SUM(transsembakodetailbarang.QtyJual) as QtyJual, 
            // SUM(transsembakodetailbarang.Nominal) as Nominal'))
            // ->leftJoin('transsembakoheader', 'transsembakoheader.TransSembakoID', '=', 'TransSembakoDetailBarang.TransSembakoID')
            // ->groupBy('transsembakoheader.KodeBarang','transsembakodetailbarang.NamaBarang')
            // ->where('transsembakoheader.Tanggal','>=',$request->tanggal_mulai.' 00:00:00')
            // ->where('transsembakoheader.Tanggal','<=',$request->tanggal_sampai.' 59:59:59')
            // ->where('transsembakoheader.IdLokasi',$request->IdLokasi)
            // ->get();
            
            $data = DB::select('
                SELECT
                transsembakodetailbarang.KodeBarang,
                transsembakodetailbarang.NamaBarang,
                SUM(transsembakodetailbarang.QtyJual) AS QtyJual, 
                SUM(transsembakodetailbarang.Nominal) AS Nominal 
                FROM `transsembakodetailbarang` 
                LEFT JOIN `transsembakoheader` ON `transsembakoheader`.`TransSembakoID` = `transsembakodetailbarang`.`TransSembakoID` 
                WHERE `transsembakoheader`.`Tanggal` BETWEEN ? AND ? AND `transsembakoheader`.`IdLokasi` = ?
                GROUP BY `transsembakodetailbarang`.`KodeBarang`, `transsembakodetailbarang`.`NamaBarang`
            ',[$request->tanggal_mulai.' 00:00:00',$request->tanggal_sampai.' 23:59:59',$request->IdLokasi]);
            
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }

    public function get_sembako_lokasi(Request $request){
        try{
            $lokasi = Lokasi::all();
            $data = [];
            foreach($lokasi as $row){
                $TransSembakoHeader = TransSembakoHeader::with('TransSembakoDetailBarang')
                            ->where('Tanggal','>=',$request->tanggal_mulai.' 00:00:00')
                            ->where('Tanggal','<=',$request->tanggal_sampai.' 23:59:59')
                            ->where('IdLokasi',$row->IdLokasi)
                            ->get();
                $total = 0 ;
                foreach($TransSembakoHeader as $item){
                    foreach($item->TransSembakoDetailBarang as $item){
                        $total = $total+ $item->Nominal;
                    }
                }
                $row->total = $total;
                $data[] = $row;
            }
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }
}
