<?php

namespace App\Http\Controllers;
use Mail;
use App\Mail\Mail as PasswordMail;
use App\Models\Approvisionnement;
use App\Models\Compte;
use App\Models\Log;
use App\Models\TransactionOperationType;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function ft($transaction, $i)
    {
        //error_log($i);
        return date_format(date_create($transaction['created_at']), 'm') == $i && date_format(date_create($transaction['created_at']), 'Y') == date('Y') && $transaction->transaction_type['nom'] == 'flooz';
    }
    public function dashboard(Request $request)
    {


        $flooz = TransactionType::where('nom', 'flooz')->get()[0];
        $tmoney = TransactionType::where('nom', 'tmoney')->get()[0];
        $western_union = TransactionType::where('nom', 'western union')->get()[0];
        $ria = TransactionType::where('nom', 'ria')->get()[0];
        $moneygram = TransactionType::where('nom', 'moneygram')->get()[0];

        //number_format(30000,0,',','.');

        $flooz_retrait_total = 0;
        $flooz_depot_total = 0;
        $flooz_retrait_total_nombre = 0;
        $flooz_depot_total_nombre = 0;
        //error_log($flooz->transactions);


        $flooz->transactions = $flooz->transactions->where('created_at', '>=', date("Y-m-d"))->where('deleted', false);
        foreach ($flooz->transactions as $transaction) {
            if ($transaction->transaction_operation_type['nom'] == 'depot') {
                $flooz_depot_total += $transaction['montant'];
                $flooz_depot_total_nombre += 1;

                continue;
            }
            if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                $flooz_retrait_total += $transaction['montant'];
                $flooz_retrait_total_nombre += 1;
            }

        }

        $tmoney_retrait_total = 0;
        $tmoney_depot_total = 0;
        $tmoney_retrait_total_nombre = 0;
        $tmoney_depot_total_nombre = 0;
        $tmoney->transactions = $tmoney->transactions->where('created_at', '>=', date("Y-m-d"))->where('deleted', false);
        foreach ($tmoney->transactions as $transaction) {
            if ($transaction->transaction_operation_type['nom'] == 'depot') {
                $tmoney_depot_total += $transaction['montant'];
                $tmoney_depot_total_nombre += 1;
                continue;
            }
            if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                $tmoney_retrait_total += $transaction['montant'];
                $tmoney_retrait_total_nombre += 1;
            }
        }


        $western_union_retrait_total = 0;
        $western_union_depot_total = 0; // montant total retrait western
        $western_union_retrait_total_nombre = 0;
        $western_union_depot_total_nombre = 0; // nombre total depot western union
        $western_union->transactions = $western_union->transactions->where('created_at', '>=', date("Y-m-d"))->where('deleted', false);
        foreach ($western_union->transactions as $transaction) {
            if ($transaction->transaction_operation_type['nom'] == 'depot') {
                $western_union_depot_total += $transaction['montant'];
                $western_union_depot_total_nombre += 1;
                continue;
            }
            if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                $western_union_retrait_total += $transaction['montant'];
                $western_union_retrait_total_nombre += 1;
            }
        }

        $ria_retrait_total = 0;
        $ria_depot_total = 0;
        $ria_retrait_total_nombre = 0;
        $ria_depot_total_nombre = 0;
        $ria->transactions = $ria->transactions->where('created_at', '>=', date("Y-m-d"))->where('deleted', false);
        foreach ($ria->transactions as $transaction) {
            if ($transaction->transaction_operation_type['nom'] == 'depot') {
                $ria_depot_total += $transaction['montant'];
                $ria_depot_total_nombre += 1;
                continue;
            }
            if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                $ria_retrait_total += $transaction['montant'];
                $ria_retrait_total_nombre += 1;
            }
        }

        $moneygram_retrait_total = 0;
        $moneygram_depot_total = 0;
        $moneygram_retrait_total_nombre = 0;
        $moneygram_depot_total_nombre = 0;
        $moneygram->transactions = $moneygram->transactions->where('created_at', '>=', date("Y-m-d"))->where('deleted', false);
        foreach ($moneygram->transactions as $transaction) {
            if ($transaction->transaction_operation_type['nom'] == 'depot') {
                $moneygram_depot_total += $transaction['montant'];
                $moneygram_depot_total_nombre += 1;
                continue;
            }
            if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                $moneygram_retrait_total += $transaction['montant'];
                $moneygram_retrait_total_nombre += 1;
            }
        }


        $data3 = [
            [
                $flooz_retrait_total_nombre,
                $tmoney_retrait_total_nombre,
                $ria_retrait_total_nombre,
                $western_union_retrait_total_nombre,
                $moneygram_retrait_total_nombre,

            ],
            [
                $flooz_depot_total_nombre,
                $tmoney_depot_total_nombre,
                $ria_depot_total_nombre,
                $western_union_depot_total_nombre,
                $moneygram_depot_total_nombre,
            ],
            [
                $flooz_retrait_total,
                $tmoney_retrait_total,
                $ria_retrait_total,
                $western_union_retrait_total,
                $moneygram_retrait_total,
            ],
            [
                $flooz_depot_total,
                $tmoney_depot_total,
                $ria_depot_total,
                $western_union_depot_total_nombre,
                $moneygram_depot_total,
            ],

        ];

        //error_lo

        $mois = date("m");
        $data = [];
        //error_log($flooz->transactions[0]['created_at']);
        $tmoney_depot_total_annuel = 0; // montant des depots tmoney annuel
        $tmoney_retrait_total_annuel = 0;
        $tmoney_depot_total_annuel_nombre = 0; // nombre total des depots tmoney annuel
        $tmoney_retrait_total_annuel_nombre = 0;

        $flooz_depot_total_annuel = 0;
        $flooz_retrait_total_annuel = 0;
        $flooz_depot_total_annuel_nombre = 0;
        $flooz_retrait_total_annuel_nombre = 0;

        $ria_depot_total_annuel = 0;
        $ria_retrait_total_annuel = 0;
        $ria_depot_total_annuel_nombre = 0;
        $ria_retrait_total_annuel_nombre = 0;

        $western_union_depot_total_annuel = 0;
        $western_union_retrait_total_annuel = 0;
        $western_union_depot_total_annuel_nombre = 0;
        $western_union_retrait_total_annuel_nombre = 0;

        $moneygram_depot_total_annuel = 0;
        $moneygram_retrait_total_annuel = 0;
        $moneygram_depot_total_annuel_nombre = 0;
        $moneygram_retrait_total_annuel_nombre = 0;



        for ($i = 1; $i <= $mois; $i++) {
            global $index;
            $index = $i;
            $GLOBALS['index'] = $i;
            $tmoney_depot_total_mensuel = 0;
            $tmoney_retrait_total_mensuel = 0;
            $tmoney_depot_total_mensuel_nombre = 0;
            $tmoney_retrait_total_mensuel_nombre = 0;
            $tmoney_total_mensuel = 0;
            $transactions = Transaction::cursor()->filter(function ($transaction) {
                //error_log($GLOBALS['index']);
                return date_format(date_create($transaction['created_at']), 'm') == $GLOBALS['index'] && date_format(date_create($transaction['created_at']), 'Y') == date('Y') && $transaction->transaction_type['nom'] == 'tmoney' && $transaction['deleted'] == false;
            });
            foreach ($transactions as $transaction) {
                if ($transaction->transaction_operation_type['nom'] == 'depot') {
                    $tmoney_depot_total_mensuel = $tmoney_depot_total_mensuel + $transaction['montant'];
                    $tmoney_depot_total_mensuel_nombre = $tmoney_depot_total_mensuel_nombre + 1;
                    continue;
                }
                if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                    $tmoney_retrait_total_mensuel = $tmoney_retrait_total_mensuel + $transaction['montant'];
                    $tmoney_retrait_total_mensuel_nombre = $tmoney_retrait_total_mensuel_nombre + 1;
                    continue;
                }
            }
            //$tmoney_depot_total_mensuel_nombre = $transactions->count();
            //$tmoney_retrait_total_mensuel_nombre = $transactions->count();

            $tmoney_depot_total_annuel = $tmoney_depot_total_annuel + $tmoney_depot_total_mensuel;
            $tmoney_retrait_total_annuel = $tmoney_retrait_total_annuel + $tmoney_retrait_total_mensuel;
            $tmoney_depot_total_annuel_nombre = $tmoney_depot_total_annuel_nombre + $tmoney_depot_total_mensuel_nombre;
            $tmoney_retrait_total_annuel_nombre = $tmoney_retrait_total_annuel_nombre + $tmoney_retrait_total_mensuel_nombre;

            //

            $flooz_depot_total_mensuel = 0;
            $flooz_retrait_total_mensuel = 0;
            $flooz_depot_total_mensuel_nombre = 0;
            $flooz_retrait_total_mensuel_nombre = 0;
            $flooz_total_mensuel = 0;
            $transactions = Transaction::cursor()->filter(function ($transaction) {
                return date_format(date_create($transaction['created_at']), 'm') == $GLOBALS['index'] && date_format(date_create($transaction['created_at']), 'Y') == date('Y') && $transaction->transaction_type['nom'] == 'flooz' && $transaction['deleted'] == false;
            });
            foreach ($transactions as $transaction) {
                if ($transaction->transaction_operation_type['nom'] == 'depot') {
                    $flooz_depot_total_mensuel = $flooz_depot_total_mensuel + $transaction['montant'];
                    $flooz_depot_total_mensuel_nombre = $flooz_depot_total_mensuel_nombre + 1;
                    continue;
                }
                if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                    $flooz_retrait_total_mensuel = $flooz_retrait_total_mensuel + $transaction['montant'];
                    $flooz_retrait_total_mensuel_nombre = $flooz_retrait_total_mensuel_nombre + 1;
                    continue;
                }
            }

            $flooz_depot_total_annuel = $flooz_depot_total_annuel + $flooz_depot_total_mensuel;
            $flooz_retrait_total_annuel = $flooz_retrait_total_annuel + $flooz_retrait_total_mensuel;
            $flooz_depot_total_annuel_nombre = $flooz_depot_total_annuel_nombre + $flooz_depot_total_mensuel_nombre;
            $flooz_retrait_total_annuel_nombre = $flooz_retrait_total_annuel_nombre + $flooz_retrait_total_mensuel_nombre;

            $ria_depot_total_mensuel = 0;
            $ria_retrait_total_mensuel = 0;
            $ria_depot_total_mensuel_nombre = 0;
            $ria_retrait_total_mensuel_nombre = 0;
            $ria_total_mensuel = 0;
            $transactions = Transaction::cursor()->filter(function ($transaction) {
                return date_format(date_create($transaction['created_at']), 'm') == $GLOBALS['index'] && date_format(date_create($transaction['created_at']), 'Y') == date('Y') && $transaction->transaction_type['nom'] == 'ria' && $transaction['deleted'] == false;
            });
            foreach ($transactions as $transaction) {
                if ($transaction->transaction_operation_type['nom'] == 'depot') {
                    $ria_depot_total_mensuel = $ria_depot_total_mensuel + $transaction['montant'];
                    $ria_depot_total_mensuel_nombre += 1;
                    continue;
                }
                if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                    $ria_retrait_total_mensuel = $ria_retrait_total_mensuel + $transaction['montant'];
                    $ria_retrait_total_mensuel_nombre += 1;
                    continue;
                }
            }
            $ria_depot_total_annuel = $ria_depot_total_annuel + $ria_depot_total_mensuel;
            $ria_retrait_total_annuel = $ria_retrait_total_annuel + $ria_retrait_total_mensuel;
            $ria_depot_total_annuel_nombre += $ria_depot_total_mensuel_nombre;
            $ria_retrait_total_annuel_nombre += $ria_retrait_total_mensuel_nombre;


            $western_union_depot_total_mensuel = 0;
            $western_union_retrait_total_mensuel = 0;
            $western_union_depot_total_mensuel_nombre = 0;
            $western_union_retrait_total_mensuel_nombre = 0;
            $western_union_total_mensuel = 0;
            $transactions = Transaction::cursor()->filter(function ($transaction) {
                return date_format(date_create($transaction['created_at']), 'm') == $GLOBALS['index'] && date_format(date_create($transaction['created_at']), 'Y') == date('Y') && $transaction->transaction_type['nom'] == 'western union' && $transaction['deleted'] == false;
            });
            foreach ($transactions as $transaction) {
                if ($transaction->transaction_operation_type['nom'] == 'depot') {
                    $western_union_depot_total_mensuel = $western_union_depot_total_mensuel + $transaction['montant'];
                    $western_union_depot_total_mensuel_nombre += 1;
                    continue;
                }
                if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                    $western_union_retrait_total_mensuel = $western_union_retrait_total_mensuel + $transaction['montant'];
                    $western_union_retrait_total_mensuel_nombre += 1;
                    continue;
                }
            }
            $western_union_depot_total_annuel = $western_union_depot_total_annuel + $western_union_depot_total_mensuel;
            $western_union_retrait_total_annuel = $western_union_retrait_total_annuel + $western_union_retrait_total_mensuel;
            $western_union_depot_total_annuel_nombre += $western_union_depot_total_mensuel_nombre;
            $western_union_retrait_total_annuel_nombre += $western_union_retrait_total_mensuel_nombre;

            $moneygram_depot_total_mensuel = 0;
            $moneygram_retrait_total_mensuel = 0;
            $moneygram_depot_total_mensuel_nombre = 0;
            $moneygram_retrait_total_mensuel_nombre = 0;
            $moneygram_union_total_mensuel = 0;
            $transactions = Transaction::cursor()->filter(function ($transaction) {
                return date_format(date_create($transaction['created_at']), 'm') == $GLOBALS['index'] && date_format(date_create($transaction['created_at']), 'Y') == date('Y') && $transaction->transaction_type['nom'] == 'moneygram' && $transaction['deleted'] == false;
            });
            foreach ($transactions as $transaction) {
                if ($transaction->transaction_operation_type['nom'] == 'depot') {
                    $moneygram_depot_total_mensuel = $moneygram_depot_total_mensuel + $transaction['montant'];
                    $moneygram_depot_total_mensuel_nombre += 1;
                    continue;
                }
                if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                    $moneygram_retrait_total_mensuel = $moneygram_retrait_total_mensuel + $transaction['montant'];
                    $moneygram_retrait_total_mensuel_nombre += 1;
                    continue;
                }
            }

            $moneygram_depot_total_annuel = $moneygram_depot_total_annuel + $moneygram_depot_total_mensuel;
            $moneygram_retrait_total_annuel = $moneygram_retrait_total_annuel + $moneygram_retrait_total_mensuel;
            $moneygram_depot_total_annuel_nombre += $moneygram_depot_total_mensuel_nombre;
            $moneygram_retrait_total_annuel_nombre += $moneygram_retrait_total_mensuel_nombre;


            $data[$i] = [
                $i,
                [$flooz_retrait_total_mensuel, $flooz_depot_total_mensuel, $flooz_retrait_total_mensuel_nombre, $flooz_depot_total_mensuel_nombre],
                [$tmoney_retrait_total_mensuel, $tmoney_depot_total_mensuel, $tmoney_retrait_total_mensuel_nombre, $tmoney_depot_total_mensuel_nombre],
                [$ria_retrait_total_mensuel, $ria_depot_total_mensuel, $ria_retrait_total_annuel_nombre, $ria_depot_total_mensuel_nombre],
                [$western_union_retrait_total_mensuel, $western_union_depot_total_mensuel, $western_union_retrait_total_mensuel_nombre, $western_union_depot_total_mensuel_nombre],
                [$moneygram_retrait_total_mensuel, $moneygram_depot_total_mensuel, $moneygram_retrait_total_mensuel_nombre, $moneygram_depot_total_mensuel_nombre],
            ];

            //error_log($flooz_depot_total_mensuel);
            //error_log($flooz_retrait_total_mensuel);

        }
        /*for($i = 1; $i <= $mois ; $i++){
            global $index;
            $index  = $i;
            $GLOBALS['index'] = $i;

            $tmoney_depot_total_mensuel = 0;
            $tmoney_retrait_total_mensuel = 0;
            $tmoney_total_mensuel = 0;
            $transactions = Transactions::cursor()->filter(function($transaction){
                //error_log($GLOBALS['index']);
                return date_format(date_create($transaction['created_at']),'m') == $GLOBALS['index'] && date_format(date_create($transaction['created_at']),'Y') == date('Y') && $transaction->transaction_type['nom'] == 'tmoney';
            });
            foreach($transactions as $transaction){
                if($transaction->transaction_operation_type['nom'] == 'depot' ){
                    $tmoney_depot_total_mensuel = $tmoney_depot_total_mensuel + $transaction['montant'];
                    continue;
                }
                if($transaction->transaction_operation_type['nom'] == 'retrait' ){
                    $tmoney_retrait_total_mensuel = $tmoney_retrait_total_mensuel + $transaction['montant'];
                    continue;
                }
            }
            $tmoney_depot_total_annuel =  $tmoney_depot_total_annuel +  $tmoney_depot_total_mensuel ;
            $tmoney_retrait_total_annuel =  $tmoney_retrait_total_annuel +  $tmoney_retrait_total_mensuel ;

            $flooz_depot_total_mensuel = 0;
            $flooz_retrait_total_mensuel = 0;
            $flooz_total_mensuel = 0;
            $transactions = Transactions::cursor()->filter(function($transaction){
                return date_format(date_create($transaction['created_at']),'m') == $GLOBALS['index'] && date_format(date_create($transaction['created_at']),'Y') == date('Y') && $transaction->transaction_type['nom'] == 'flooz';
            });
            foreach($transactions as $transaction){
                if($transaction->transaction_operation_type['nom'] == 'depot' ){
                    $flooz_depot_total_mensuel = $flooz_depot_total_mensuel + $transaction['montant'];
                    continue;
                }
                if($transaction->transaction_operation_type['nom'] == 'retrait' ){
                    $flooz_retrait_total_mensuel = $flooz_retrait_total_mensuel + $transaction['montant'];
                    continue;
                }
            }

            $flooz_depot_total_annuel =  $flooz_depot_total_annuel +  $flooz_depot_total_mensuel ;
            $flooz_retrait_total_annuel =  $flooz_retrait_total_annuel +  $flooz_retrait_total_mensuel ;

            $ria_depot_total_mensuel = 0;
            $ria_retrait_total_mensuel = 0;
            $ria_total_mensuel = 0;
            $transactions = Transactions::cursor()->filter(function($transaction){
                return date_format(date_create($transaction['created_at']),'m') == $GLOBALS['index'] && date_format(date_create($transaction['created_at']),'Y') == date('Y') && $transaction->transaction_type['nom'] == 'ria';
            });
            foreach($transactions as $transaction){
                if($transaction->transaction_operation_type['nom'] == 'depot' ){
                    $ria_depot_total_mensuel = $ria_depot_total_mensuel + $transaction['montant'];
                    continue;
                }
                if($transaction->transaction_operation_type['nom'] == 'retrait' ){
                    $ria_retrait_total_mensuel = $ria_retrait_total_mensuel + $transaction['montant'];
                    continue;
                }
            }
            $ria_depot_total_annuel =  $ria_depot_total_annuel +  $ria_depot_total_mensuel ;
            $ria_retrait_total_annuel =  $ria_retrait_total_annuel +  $ria_retrait_total_mensuel ;


            $western_union_depot_total_mensuel = 0;
            $western_union_retrait_total_mensuel = 0;
            $western_union_total_mensuel = 0;
            $transactions = Transactions::cursor()->filter(function($transaction){
                return date_format(date_create($transaction['created_at']),'m') == $GLOBALS['index'] && date_format(date_create($transaction['created_at']),'Y') == date('Y') && $transaction->transaction_type['nom'] == 'western union';
            });
            foreach($transactions as $transaction){
                if($transaction->transaction_operation_type['nom'] == 'depot' ){
                    $western_union_depot_total_mensuel = $western_union_depot_total_mensuel + $transaction['montant'];
                    continue;
                }
                if($transaction->transaction_operation_type['nom'] == 'retrait' ){
                    $western_union_retrait_total_mensuel = $western_union_retrait_total_mensuel + $transaction['montant'];
                    continue;
                }
            }
            $western_union_depot_total_annuel =  $western_union_depot_total_annuel +  $western_union_depot_total_mensuel ;
            $western_union_retrait_total_annuel =  $western_union_retrait_total_annuel +  $western_union_retrait_total_mensuel ;

            $moneygram_depot_total_mensuel = 0;
            $moneygram_retrait_total_mensuel = 0;
            $moneygram_union_total_mensuel = 0;
            $transactions = Transactions::cursor()->filter(function($transaction){
                return date_format(date_create($transaction['created_at']),'m') == $GLOBALS['index'] && date_format(date_create($transaction['created_at']),'Y') == date('Y') && $transaction->transaction_type['nom'] == 'moneygram';
            });
            foreach($transactions as $transaction){
                if($transaction->transaction_operation_type['nom'] == 'depot' ){
                    $moneygram_depot_total_mensuel = $moneygram_depot_total_mensuel + $transaction['montant'];
                    continue;
                }
                if($transaction->transaction_operation_type['nom'] == 'retrait' ){
                    $moneygram_retrait_total_mensuel = $moneygram_retrait_total_mensuel + $transaction['montant'];
                    continue;
                }
            }

            $moneygram_depot_total_annuel =  $moneygram_depot_total_annuel +  $moneygram_depot_total_mensuel ;
            $moneygram_retrait_total_annuel =  $moneygram_retrait_total_annuel +  $moneygram_retrait_total_mensuel ;

            
            $data [$i] = [
                $i,
                [$flooz_retrait_total_mensuel,$flooz_depot_total_mensuel],
                [$tmoney_retrait_total_mensuel,$tmoney_depot_total_mensuel],
                [$ria_retrait_total_mensuel,$ria_depot_total_mensuel],
                [$western_union_retrait_total_mensuel,$western_union_depot_total_mensuel],
                [$moneygram_retrait_total_mensuel,$moneygram_depot_total_mensuel],
            ];

            //error_log($flooz_depot_total_mensuel);
            //error_log($flooz_retrait_total_mensuel);
            
        }*/
        $data2 = [
            'flooz' => [$flooz_retrait_total_annuel, $flooz_depot_total_annuel, $flooz_retrait_total_annuel_nombre, $flooz_depot_total_annuel_nombre],
            'tmoney' => [$tmoney_retrait_total_annuel, $tmoney_depot_total_annuel, $tmoney_retrait_total_annuel_nombre, $tmoney_depot_total_annuel_nombre],
            'ria' => [$ria_retrait_total_annuel, $ria_depot_total_annuel, $ria_retrait_total_annuel_nombre, $ria_depot_total_annuel_nombre],
            'western_union' => [$western_union_retrait_total_annuel, $western_union_depot_total_annuel, $western_union_retrait_total_annuel_nombre, $western_union_depot_total_annuel_nombre],
            'moneygram' => [$moneygram_retrait_total_annuel, $moneygram_depot_total_annuel, $moneygram_retrait_total_annuel_nombre, $moneygram_depot_total_annuel_nombre],
        ];

        $trans = Transaction::cursor()->filter(function ($transaction) {
            return date_format(date_create($transaction['created_at']), 'Y') == date('Y') && $transaction['deleted'] == false;
        });

        /*return view('statistique_annuel',[
            'data' => $data,
            'data2' => $data2,
            'transaction_nombre_total' => $trans->count(),
        ]);*/

        $transactions_du_jour = Transaction::where('created_at', '>=', date("Y-m-d"))->where('deleted', false)->get(); /*cursor()->filter(function($transaction){});*/
        //error_log($transactions_du_jour);

        $request->session()->flash('route_name', 'Tableau de bord');
        return view('dashboard', [
            'flooz' => $flooz,
            'flooz_depot_total' => $flooz_depot_total,
            'flooz_retrait_total' => $flooz_retrait_total,
            'tmoney' => $tmoney,
            'tmoney_depot_total' => $tmoney_depot_total,
            'tmoney_retrait_total' => $tmoney_retrait_total,
            'western_union' => $western_union,
            'western_union_depot_total' => $western_union_depot_total,
            'western_union_retrait_total' => $western_union_retrait_total,
            'ria' => $ria,
            'ria_depot_total' => $ria_depot_total,
            'ria_retrait_total' => $ria_retrait_total,
            'moneygram' => $moneygram,
            'moneygram_depot_total' => $moneygram_depot_total,
            'moneygram_retrait_total' => $moneygram_retrait_total,
            'data' => $data,
            'data2' => $data2,
            'data3' => $data3,
            'transactions_du_jour' => $transactions_du_jour,
            'transaction_nombre_total' => $trans->count(),
        ])->with('route_name', 'Tableau de bord');


    }
    public function statistique_transaction(Request $request)
    {

        $flooz = TransactionType::where('nom', 'flooz')->get()[0];
        $tmoney = TransactionType::where('nom', 'tmoney')->get()[0];
        $ria = TransactionType::where('nom', 'ria')->get()[0];
        $western_union = TransactionType::where('nom', 'western union')->get()[0];
        $moneygram = TransactionType::where('nom', 'moneygram')->get()[0];

        if ($request->input('date_debut') != null && $request->input('date_debut') != '') {
            $flooz->transactions = $flooz->transactions->whereBetween('created_at', [$request->input('date_debut'), $request->input('date_fin')])->where('deleted', false);
            $tmoney->transactions = $tmoney->transactions->whereBetween('created_at', [$request->input('date_debut'), $request->input('date_fin')])->where('deleted', false);
            $ria->transactions = $ria->transactions->whereBetween('created_at', [$request->input('date_debut'), $request->input('date_fin')])->where('deleted', false);
            $western_union->transactions = $western_union->transactions->whereBetween('created_at', [$request->input('date_debut'), $request->input('date_fin')])->where('deleted', false);
            $moneygram->transactions = $moneygram->transactions->whereBetween('created_at', [$request->input('date_debut'), $request->input('date_fin')])->where('deleted', false);
            return view('statistique', [
                'flooz' => $flooz,
                'tmoney' => $tmoney,
                'ria' => $ria,
                'western_union' => $western_union,
                'moneygram' => $moneygram,
                'date_debut' => $request->input('date_debut'),
                'date_fin' => $request->input('date_fin'),
            ]);
        }

        $flooz->transactions = $flooz->transactions->where('created_at', date('Y-m-d'))->where('deleted', false);
        $tmoney->transactions = $tmoney->transactions->where('created_at', date('Y-m-d'))->where('deleted', false);
        $ria->transactions = $ria->transactions->where('created_at', date('Y-m-d'))->where('deleted', false);
        $western_union->transactions = $western_union->transactions->where('created_at', date('Y-m-d'))->where('deleted', false);
        $moneygram->transactions = $moneygram->transactions->where('created_at', date('Y-m-d'))->where('deleted', false);


        return view('statistique_transaction', [
            'flooz' => $flooz,
            'tmoney' => $tmoney,
            'ria' => $ria,
            'western_union' => $western_union,
            'moneygram' => $moneygram,
        ]);


    }
    public function statistique_annuel()
    {
        $mois = date("m");
        $data = [];
        //error_log($flooz->transactions[0]['created_at']);
        $tmoney_depot_total_annuel = 0; // montant des depots tmoney annuel
        $tmoney_retrait_total_annuel = 0;
        $tmoney_depot_total_annuel_nombre = 0; // nombre total des depots tmoney annuel
        $tmoney_retrait_total_annuel_nombre = 0;

        $flooz_depot_total_annuel = 0;
        $flooz_retrait_total_annuel = 0;
        $flooz_depot_total_annuel_nombre = 0;
        $flooz_retrait_total_annuel_nombre = 0;

        $ria_depot_total_annuel = 0;
        $ria_retrait_total_annuel = 0;
        $ria_depot_total_annuel_nombre = 0;
        $ria_retrait_total_annuel_nombre = 0;

        $western_union_depot_total_annuel = 0;
        $western_union_retrait_total_annuel = 0;
        $western_union_depot_total_annuel_nombre = 0;
        $western_union_retrait_total_annuel_nombre = 0;

        $moneygram_depot_total_annuel = 0;
        $moneygram_retrait_total_annuel = 0;
        $moneygram_depot_total_annuel_nombre = 0;
        $moneygram_retrait_total_annuel_nombre = 0;



        for ($i = 1; $i <= $mois; $i++) {
            global $index;
            $index = $i;
            $GLOBALS['index'] = $i;
            $tmoney_depot_total_mensuel = 0;
            $tmoney_retrait_total_mensuel = 0;
            $tmoney_depot_total_mensuel_nombre = 0;
            $tmoney_retrait_total_mensuel_nombre = 0;
            $tmoney_total_mensuel = 0;
            $transactions = Transaction::cursor()->filter(function ($transaction) {
                //error_log($GLOBALS['index']);
                return date_format(date_create($transaction['created_at']), 'm') == $GLOBALS['index'] && date_format(date_create($transaction['created_at']), 'Y') == date('Y') && $transaction->transaction_type['nom'] == 'tmoney' && $transaction['deleted'] == false;
            });
            foreach ($transactions as $transaction) {
                if ($transaction->transaction_operation_type['nom'] == 'depot') {
                    $tmoney_depot_total_mensuel = $tmoney_depot_total_mensuel + $transaction['montant'];
                    $tmoney_depot_total_mensuel_nombre = $tmoney_depot_total_mensuel_nombre + 1;
                    continue;
                }
                if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                    $tmoney_retrait_total_mensuel = $tmoney_retrait_total_mensuel + $transaction['montant'];
                    $tmoney_retrait_total_mensuel_nombre = $tmoney_retrait_total_mensuel_nombre + 1;
                    continue;
                }
            }
            //$tmoney_depot_total_mensuel_nombre = $transactions->count();
            //$tmoney_retrait_total_mensuel_nombre = $transactions->count();

            $tmoney_depot_total_annuel = $tmoney_depot_total_annuel + $tmoney_depot_total_mensuel;
            $tmoney_retrait_total_annuel = $tmoney_retrait_total_annuel + $tmoney_retrait_total_mensuel;
            $tmoney_depot_total_annuel_nombre = $tmoney_depot_total_annuel_nombre + $tmoney_depot_total_mensuel_nombre;
            $tmoney_retrait_total_annuel_nombre = $tmoney_retrait_total_annuel_nombre + $tmoney_retrait_total_mensuel_nombre;

            //

            $flooz_depot_total_mensuel = 0;
            $flooz_retrait_total_mensuel = 0;
            $flooz_depot_total_mensuel_nombre = 0;
            $flooz_retrait_total_mensuel_nombre = 0;
            $flooz_total_mensuel = 0;
            $transactions = Transaction::cursor()->filter(function ($transaction) {
                return date_format(date_create($transaction['created_at']), 'm') == $GLOBALS['index'] && date_format(date_create($transaction['created_at']), 'Y') == date('Y') && $transaction->transaction_type['nom'] == 'flooz' && $transaction['deleted'] == false;
            });
            foreach ($transactions as $transaction) {
                if ($transaction->transaction_operation_type['nom'] == 'depot') {
                    $flooz_depot_total_mensuel = $flooz_depot_total_mensuel + $transaction['montant'];
                    $flooz_depot_total_mensuel_nombre = $flooz_depot_total_mensuel_nombre + 1;
                    continue;
                }
                if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                    $flooz_retrait_total_mensuel = $flooz_retrait_total_mensuel + $transaction['montant'];
                    $flooz_retrait_total_mensuel_nombre = $flooz_retrait_total_mensuel_nombre + 1;
                    continue;
                }
            }

            $flooz_depot_total_annuel = $flooz_depot_total_annuel + $flooz_depot_total_mensuel;
            $flooz_retrait_total_annuel = $flooz_retrait_total_annuel + $flooz_retrait_total_mensuel;
            $flooz_depot_total_annuel_nombre = $flooz_depot_total_annuel_nombre + $flooz_depot_total_mensuel_nombre;
            $flooz_retrait_total_annuel_nombre = $flooz_retrait_total_annuel_nombre + $flooz_retrait_total_mensuel_nombre;

            $ria_depot_total_mensuel = 0;
            $ria_retrait_total_mensuel = 0;
            $ria_depot_total_mensuel_nombre = 0;
            $ria_retrait_total_mensuel_nombre = 0;
            $ria_total_mensuel = 0;
            $transactions = Transaction::cursor()->filter(function ($transaction) {
                return date_format(date_create($transaction['created_at']), 'm') == $GLOBALS['index'] && date_format(date_create($transaction['created_at']), 'Y') == date('Y') && $transaction->transaction_type['nom'] == 'ria' && $transaction['deleted'] == false;
            });
            foreach ($transactions as $transaction) {
                if ($transaction->transaction_operation_type['nom'] == 'depot') {
                    $ria_depot_total_mensuel = $ria_depot_total_mensuel + $transaction['montant'];
                    $ria_depot_total_mensuel_nombre += 1;
                    continue;
                }
                if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                    $ria_retrait_total_mensuel = $ria_retrait_total_mensuel + $transaction['montant'];
                    $ria_retrait_total_mensuel_nombre += 1;
                    continue;
                }
            }
            $ria_depot_total_annuel = $ria_depot_total_annuel + $ria_depot_total_mensuel;
            $ria_retrait_total_annuel = $ria_retrait_total_annuel + $ria_retrait_total_mensuel;
            $ria_depot_total_annuel_nombre += $ria_depot_total_mensuel_nombre;
            $ria_retrait_total_annuel_nombre += $ria_retrait_total_mensuel_nombre;


            $western_union_depot_total_mensuel = 0;
            $western_union_retrait_total_mensuel = 0;
            $western_union_depot_total_mensuel_nombre = 0;
            $western_union_retrait_total_mensuel_nombre = 0;
            $western_union_total_mensuel = 0;
            $transactions = Transaction::cursor()->filter(function ($transaction) {
                return date_format(date_create($transaction['created_at']), 'm') == $GLOBALS['index'] && date_format(date_create($transaction['created_at']), 'Y') == date('Y') && $transaction->transaction_type['nom'] == 'western union' && $transaction['deleted'] == false;
            });
            foreach ($transactions as $transaction) {
                if ($transaction->transaction_operation_type['nom'] == 'depot') {
                    $western_union_depot_total_mensuel = $western_union_depot_total_mensuel + $transaction['montant'];
                    $western_union_depot_total_mensuel_nombre += 1;
                    continue;
                }
                if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                    $western_union_retrait_total_mensuel = $western_union_retrait_total_mensuel + $transaction['montant'];
                    $western_union_retrait_total_mensuel_nombre += 1;
                    continue;
                }
            }
            $western_union_depot_total_annuel = $western_union_depot_total_annuel + $western_union_depot_total_mensuel;
            $western_union_retrait_total_annuel = $western_union_retrait_total_annuel + $western_union_retrait_total_mensuel;
            $western_union_depot_total_annuel_nombre += $western_union_depot_total_mensuel_nombre;
            $western_union_retrait_total_annuel_nombre += $western_union_retrait_total_mensuel_nombre;

            $moneygram_depot_total_mensuel = 0;
            $moneygram_retrait_total_mensuel = 0;
            $moneygram_depot_total_mensuel_nombre = 0;
            $moneygram_retrait_total_mensuel_nombre = 0;
            $moneygram_union_total_mensuel = 0;
            $transactions = Transaction::cursor()->filter(function ($transaction) {
                return date_format(date_create($transaction['created_at']), 'm') == $GLOBALS['index'] && date_format(date_create($transaction['created_at']), 'Y') == date('Y') && $transaction->transaction_type['nom'] == 'moneygram' && $transaction['deleted'] == false;
            });
            foreach ($transactions as $transaction) {
                if ($transaction->transaction_operation_type['nom'] == 'depot') {
                    $moneygram_depot_total_mensuel = $moneygram_depot_total_mensuel + $transaction['montant'];
                    $moneygram_depot_total_mensuel_nombre += 1;
                    continue;
                }
                if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                    $moneygram_retrait_total_mensuel = $moneygram_retrait_total_mensuel + $transaction['montant'];
                    $moneygram_retrait_total_mensuel_nombre += 1;
                    continue;
                }
            }

            $moneygram_depot_total_annuel = $moneygram_depot_total_annuel + $moneygram_depot_total_mensuel;
            $moneygram_retrait_total_annuel = $moneygram_retrait_total_annuel + $moneygram_retrait_total_mensuel;
            $moneygram_depot_total_annuel_nombre += $moneygram_depot_total_mensuel_nombre;
            $moneygram_retrait_total_annuel_nombre += $moneygram_retrait_total_mensuel_nombre;


            $data[$i] = [
                $i,
                [$flooz_retrait_total_mensuel, $flooz_depot_total_mensuel, $flooz_retrait_total_mensuel_nombre, $flooz_depot_total_mensuel_nombre],
                [$tmoney_retrait_total_mensuel, $tmoney_depot_total_mensuel, $tmoney_retrait_total_mensuel_nombre, $tmoney_depot_total_mensuel_nombre],
                [$ria_retrait_total_mensuel, $ria_depot_total_mensuel, $ria_retrait_total_annuel_nombre, $ria_depot_total_mensuel_nombre],
                [$western_union_retrait_total_mensuel, $western_union_depot_total_mensuel, $western_union_retrait_total_mensuel_nombre, $western_union_depot_total_mensuel_nombre],
                [$moneygram_retrait_total_mensuel, $moneygram_depot_total_mensuel, $moneygram_retrait_total_mensuel_nombre, $moneygram_depot_total_mensuel_nombre],
            ];

            //error_log($flooz_depot_total_mensuel);
            //error_log($flooz_retrait_total_mensuel);

        }
        /*for($i = 1; $i <= $mois ; $i++){
            global $index;
            $index  = $i;
            $GLOBALS['index'] = $i;

            $tmoney_depot_total_mensuel = 0;
            $tmoney_retrait_total_mensuel = 0;
            $tmoney_total_mensuel = 0;
            $transactions = Transactions::cursor()->filter(function($transaction){
                //error_log($GLOBALS['index']);
                return date_format(date_create($transaction['created_at']),'m') == $GLOBALS['index'] && date_format(date_create($transaction['created_at']),'Y') == date('Y') && $transaction->transaction_type['nom'] == 'tmoney';
            });
            foreach($transactions as $transaction){
                if($transaction->transaction_operation_type['nom'] == 'depot' ){
                    $tmoney_depot_total_mensuel = $tmoney_depot_total_mensuel + $transaction['montant'];
                    continue;
                }
                if($transaction->transaction_operation_type['nom'] == 'retrait' ){
                    $tmoney_retrait_total_mensuel = $tmoney_retrait_total_mensuel + $transaction['montant'];
                    continue;
                }
            }
            $tmoney_depot_total_annuel =  $tmoney_depot_total_annuel +  $tmoney_depot_total_mensuel ;
            $tmoney_retrait_total_annuel =  $tmoney_retrait_total_annuel +  $tmoney_retrait_total_mensuel ;

            $flooz_depot_total_mensuel = 0;
            $flooz_retrait_total_mensuel = 0;
            $flooz_total_mensuel = 0;
            $transactions = Transactions::cursor()->filter(function($transaction){
                return date_format(date_create($transaction['created_at']),'m') == $GLOBALS['index'] && date_format(date_create($transaction['created_at']),'Y') == date('Y') && $transaction->transaction_type['nom'] == 'flooz';
            });
            foreach($transactions as $transaction){
                if($transaction->transaction_operation_type['nom'] == 'depot' ){
                    $flooz_depot_total_mensuel = $flooz_depot_total_mensuel + $transaction['montant'];
                    continue;
                }
                if($transaction->transaction_operation_type['nom'] == 'retrait' ){
                    $flooz_retrait_total_mensuel = $flooz_retrait_total_mensuel + $transaction['montant'];
                    continue;
                }
            }

            $flooz_depot_total_annuel =  $flooz_depot_total_annuel +  $flooz_depot_total_mensuel ;
            $flooz_retrait_total_annuel =  $flooz_retrait_total_annuel +  $flooz_retrait_total_mensuel ;

            $ria_depot_total_mensuel = 0;
            $ria_retrait_total_mensuel = 0;
            $ria_total_mensuel = 0;
            $transactions = Transactions::cursor()->filter(function($transaction){
                return date_format(date_create($transaction['created_at']),'m') == $GLOBALS['index'] && date_format(date_create($transaction['created_at']),'Y') == date('Y') && $transaction->transaction_type['nom'] == 'ria';
            });
            foreach($transactions as $transaction){
                if($transaction->transaction_operation_type['nom'] == 'depot' ){
                    $ria_depot_total_mensuel = $ria_depot_total_mensuel + $transaction['montant'];
                    continue;
                }
                if($transaction->transaction_operation_type['nom'] == 'retrait' ){
                    $ria_retrait_total_mensuel = $ria_retrait_total_mensuel + $transaction['montant'];
                    continue;
                }
            }
            $ria_depot_total_annuel =  $ria_depot_total_annuel +  $ria_depot_total_mensuel ;
            $ria_retrait_total_annuel =  $ria_retrait_total_annuel +  $ria_retrait_total_mensuel ;


            $western_union_depot_total_mensuel = 0;
            $western_union_retrait_total_mensuel = 0;
            $western_union_total_mensuel = 0;
            $transactions = Transactions::cursor()->filter(function($transaction){
                return date_format(date_create($transaction['created_at']),'m') == $GLOBALS['index'] && date_format(date_create($transaction['created_at']),'Y') == date('Y') && $transaction->transaction_type['nom'] == 'western union';
            });
            foreach($transactions as $transaction){
                if($transaction->transaction_operation_type['nom'] == 'depot' ){
                    $western_union_depot_total_mensuel = $western_union_depot_total_mensuel + $transaction['montant'];
                    continue;
                }
                if($transaction->transaction_operation_type['nom'] == 'retrait' ){
                    $western_union_retrait_total_mensuel = $western_union_retrait_total_mensuel + $transaction['montant'];
                    continue;
                }
            }
            $western_union_depot_total_annuel =  $western_union_depot_total_annuel +  $western_union_depot_total_mensuel ;
            $western_union_retrait_total_annuel =  $western_union_retrait_total_annuel +  $western_union_retrait_total_mensuel ;

            $moneygram_depot_total_mensuel = 0;
            $moneygram_retrait_total_mensuel = 0;
            $moneygram_union_total_mensuel = 0;
            $transactions = Transactions::cursor()->filter(function($transaction){
                return date_format(date_create($transaction['created_at']),'m') == $GLOBALS['index'] && date_format(date_create($transaction['created_at']),'Y') == date('Y') && $transaction->transaction_type['nom'] == 'moneygram';
            });
            foreach($transactions as $transaction){
                if($transaction->transaction_operation_type['nom'] == 'depot' ){
                    $moneygram_depot_total_mensuel = $moneygram_depot_total_mensuel + $transaction['montant'];
                    continue;
                }
                if($transaction->transaction_operation_type['nom'] == 'retrait' ){
                    $moneygram_retrait_total_mensuel = $moneygram_retrait_total_mensuel + $transaction['montant'];
                    continue;
                }
            }

            $moneygram_depot_total_annuel =  $moneygram_depot_total_annuel +  $moneygram_depot_total_mensuel ;
            $moneygram_retrait_total_annuel =  $moneygram_retrait_total_annuel +  $moneygram_retrait_total_mensuel ;

            
            $data [$i] = [
                $i,
                [$flooz_retrait_total_mensuel,$flooz_depot_total_mensuel],
                [$tmoney_retrait_total_mensuel,$tmoney_depot_total_mensuel],
                [$ria_retrait_total_mensuel,$ria_depot_total_mensuel],
                [$western_union_retrait_total_mensuel,$western_union_depot_total_mensuel],
                [$moneygram_retrait_total_mensuel,$moneygram_depot_total_mensuel],
            ];

            //error_log($flooz_depot_total_mensuel);
            //error_log($flooz_retrait_total_mensuel);
            
        }*/
        $data2 = [
            'flooz' => [$flooz_retrait_total_annuel, $flooz_depot_total_annuel, $flooz_retrait_total_annuel_nombre, $flooz_depot_total_annuel_nombre],
            'tmoney' => [$tmoney_retrait_total_annuel, $tmoney_depot_total_annuel, $tmoney_retrait_total_annuel_nombre, $tmoney_depot_total_annuel_nombre],
            'ria' => [$ria_retrait_total_annuel, $ria_depot_total_annuel, $ria_retrait_total_annuel_nombre, $ria_depot_total_annuel_nombre],
            'western_union' => [$western_union_retrait_total_annuel, $western_union_depot_total_annuel, $western_union_retrait_total_annuel_nombre, $western_union_depot_total_annuel_nombre],
            'moneygram' => [$moneygram_retrait_total_annuel, $moneygram_depot_total_annuel, $moneygram_retrait_total_annuel_nombre, $moneygram_depot_total_annuel_nombre],
        ];

        $trans = Transaction::cursor()->filter(function ($transaction) {
            return date_format(date_create($transaction['created_at']), 'Y') == date('Y') && $transaction['deleted'] == false;
        });

        return view('statistique_annuel', [
            'data' => $data,
            'data2' => $data2,
            'transaction_nombre_total' => $trans->count(),
        ]);
    }

    public function statistique_annuel_nombre()
    {
        $mois = date("m");
        $data = [];
        //error_log($flooz->transactions[0]['created_at']);
        $tmoney_depot_total_annuel = 0; // montant des depots tmoney annuel
        $tmoney_retrait_total_annuel = 0;
        $tmoney_depot_total_annuel_nombre = 0; // nombre total des depots tmoney annuel
        $tmoney_retrait_total_annuel_nombre = 0;

        $flooz_depot_total_annuel = 0;
        $flooz_retrait_total_annuel = 0;
        $flooz_depot_total_annuel_nombre = 0;
        $flooz_retrait_total_annuel_nombre = 0;

        $ria_depot_total_annuel = 0;
        $ria_retrait_total_annuel = 0;
        $ria_depot_total_annuel_nombre = 0;
        $ria_retrait_total_annuel_nombre = 0;

        $western_union_depot_total_annuel = 0;
        $western_union_retrait_total_annuel = 0;
        $western_union_depot_total_annuel_nombre = 0;
        $western_union_retrait_total_annuel_nombre = 0;

        $moneygram_depot_total_annuel = 0;
        $moneygram_retrait_total_annuel = 0;
        $moneygram_depot_total_annuel_nombre = 0;
        $moneygram_retrait_total_annuel_nombre = 0;



        for ($i = 1; $i <= $mois; $i++) {
            global $index;
            $index = $i;
            $GLOBALS['index'] = $i;
            $tmoney_depot_total_mensuel = 0;
            $tmoney_retrait_total_mensuel = 0;
            $tmoney_depot_total_mensuel_nombre = 0;
            $tmoney_retrait_total_mensuel_nombre = 0;
            $tmoney_total_mensuel = 0;
            $transactions = Transaction::cursor()->filter(function ($transaction) {
                //error_log($GLOBALS['index']);
                return date_format(date_create($transaction['created_at']), 'm') == $GLOBALS['index'] && date_format(date_create($transaction['created_at']), 'Y') == date('Y') && $transaction->transaction_type['nom'] == 'tmoney' && $transaction['deleted'] == false;
            });
            foreach ($transactions as $transaction) {
                if ($transaction->transaction_operation_type['nom'] == 'depot') {
                    $tmoney_depot_total_mensuel = $tmoney_depot_total_mensuel + $transaction['montant'];
                    $tmoney_depot_total_mensuel_nombre = $tmoney_depot_total_mensuel_nombre + 1;
                    continue;
                }
                if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                    $tmoney_retrait_total_mensuel = $tmoney_retrait_total_mensuel + $transaction['montant'];
                    $tmoney_retrait_total_mensuel_nombre = $tmoney_retrait_total_mensuel_nombre + 1;
                    continue;
                }
            }
            //$tmoney_depot_total_mensuel_nombre = $transactions->count();
            //$tmoney_retrait_total_mensuel_nombre = $transactions->count();

            $tmoney_depot_total_annuel = $tmoney_depot_total_annuel + $tmoney_depot_total_mensuel;
            $tmoney_retrait_total_annuel = $tmoney_retrait_total_annuel + $tmoney_retrait_total_mensuel;
            $tmoney_depot_total_annuel_nombre = $tmoney_depot_total_annuel_nombre + $tmoney_depot_total_mensuel_nombre;
            $tmoney_retrait_total_annuel_nombre = $tmoney_retrait_total_annuel_nombre + $tmoney_retrait_total_mensuel_nombre;

            //

            $flooz_depot_total_mensuel = 0;
            $flooz_retrait_total_mensuel = 0;
            $flooz_depot_total_mensuel_nombre = 0;
            $flooz_retrait_total_mensuel_nombre = 0;
            $flooz_total_mensuel = 0;
            $transactions = Transaction::cursor()->filter(function ($transaction) {
                return date_format(date_create($transaction['created_at']), 'm') == $GLOBALS['index'] && date_format(date_create($transaction['created_at']), 'Y') == date('Y') && $transaction->transaction_type['nom'] == 'flooz' && $transaction['deleted'] == false;
            });
            foreach ($transactions as $transaction) {
                if ($transaction->transaction_operation_type['nom'] == 'depot') {
                    $flooz_depot_total_mensuel = $flooz_depot_total_mensuel + $transaction['montant'];
                    $flooz_depot_total_mensuel_nombre = $flooz_depot_total_mensuel_nombre + 1;
                    continue;
                }
                if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                    $flooz_retrait_total_mensuel = $flooz_retrait_total_mensuel + $transaction['montant'];
                    $flooz_retrait_total_mensuel_nombre = $flooz_retrait_total_mensuel_nombre + 1;
                    continue;
                }
            }

            $flooz_depot_total_annuel = $flooz_depot_total_annuel + $flooz_depot_total_mensuel;
            $flooz_retrait_total_annuel = $flooz_retrait_total_annuel + $flooz_retrait_total_mensuel;
            $flooz_depot_total_annuel_nombre = $flooz_depot_total_annuel_nombre + $flooz_depot_total_mensuel_nombre;
            $flooz_retrait_total_annuel_nombre = $flooz_retrait_total_annuel_nombre + $flooz_retrait_total_mensuel_nombre;

            $ria_depot_total_mensuel = 0;
            $ria_retrait_total_mensuel = 0;
            $ria_depot_total_mensuel_nombre = 0;
            $ria_retrait_total_mensuel_nombre = 0;
            $ria_total_mensuel = 0;
            $transactions = Transaction::cursor()->filter(function ($transaction) {
                return date_format(date_create($transaction['created_at']), 'm') == $GLOBALS['index'] && date_format(date_create($transaction['created_at']), 'Y') == date('Y') && $transaction->transaction_type['nom'] == 'ria' && $transaction['deleted'] == false;
            });
            foreach ($transactions as $transaction) {
                if ($transaction->transaction_operation_type['nom'] == 'depot') {
                    $ria_depot_total_mensuel = $ria_depot_total_mensuel + $transaction['montant'];
                    $ria_depot_total_mensuel_nombre += 1;
                    continue;
                }
                if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                    $ria_retrait_total_mensuel = $ria_retrait_total_mensuel + $transaction['montant'];
                    $ria_retrait_total_mensuel_nombre += 1;
                    continue;
                }
            }
            $ria_depot_total_annuel = $ria_depot_total_annuel + $ria_depot_total_mensuel;
            $ria_retrait_total_annuel = $ria_retrait_total_annuel + $ria_retrait_total_mensuel;
            $ria_depot_total_annuel_nombre += $ria_depot_total_mensuel_nombre;
            $ria_retrait_total_annuel_nombre += $ria_retrait_total_mensuel_nombre;


            $western_union_depot_total_mensuel = 0;
            $western_union_retrait_total_mensuel = 0;
            $western_union_depot_total_mensuel_nombre = 0;
            $western_union_retrait_total_mensuel_nombre = 0;
            $western_union_total_mensuel = 0;
            $transactions = Transaction::cursor()->filter(function ($transaction) {
                return date_format(date_create($transaction['created_at']), 'm') == $GLOBALS['index'] && date_format(date_create($transaction['created_at']), 'Y') == date('Y') && $transaction->transaction_type['nom'] == 'western union' && $transaction['deleted'] == false;
            });
            foreach ($transactions as $transaction) {
                if ($transaction->transaction_operation_type['nom'] == 'depot') {
                    $western_union_depot_total_mensuel = $western_union_depot_total_mensuel + $transaction['montant'];
                    $western_union_depot_total_mensuel_nombre += 1;
                    continue;
                }
                if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                    $western_union_retrait_total_mensuel = $western_union_retrait_total_mensuel + $transaction['montant'];
                    $western_union_retrait_total_mensuel_nombre += 1;
                    continue;
                }
            }
            $western_union_depot_total_annuel = $western_union_depot_total_annuel + $western_union_depot_total_mensuel;
            $western_union_retrait_total_annuel = $western_union_retrait_total_annuel + $western_union_retrait_total_mensuel;
            $western_union_depot_total_annuel_nombre += $western_union_depot_total_mensuel_nombre;
            $western_union_retrait_total_annuel_nombre += $western_union_retrait_total_mensuel_nombre;

            $moneygram_depot_total_mensuel = 0;
            $moneygram_retrait_total_mensuel = 0;
            $moneygram_depot_total_mensuel_nombre = 0;
            $moneygram_retrait_total_mensuel_nombre = 0;
            $moneygram_union_total_mensuel = 0;
            $transactions = Transaction::cursor()->filter(function ($transaction) {
                return date_format(date_create($transaction['created_at']), 'm') == $GLOBALS['index'] && date_format(date_create($transaction['created_at']), 'Y') == date('Y') && $transaction->transaction_type['nom'] == 'moneygram' && $transaction['deleted'] == false;
            });
            foreach ($transactions as $transaction) {
                if ($transaction->transaction_operation_type['nom'] == 'depot') {
                    $moneygram_depot_total_mensuel = $moneygram_depot_total_mensuel + $transaction['montant'];
                    $moneygram_depot_total_mensuel_nombre += 1;
                    continue;
                }
                if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                    $moneygram_retrait_total_mensuel = $moneygram_retrait_total_mensuel + $transaction['montant'];
                    $moneygram_retrait_total_mensuel_nombre += 1;
                    continue;
                }
            }

            $moneygram_depot_total_annuel = $moneygram_depot_total_annuel + $moneygram_depot_total_mensuel;
            $moneygram_retrait_total_annuel = $moneygram_retrait_total_annuel + $moneygram_retrait_total_mensuel;
            $moneygram_depot_total_annuel_nombre += $moneygram_depot_total_mensuel_nombre;
            $moneygram_retrait_total_annuel_nombre += $moneygram_retrait_total_mensuel_nombre;


            $data[$i] = [
                $i,
                [$flooz_retrait_total_mensuel, $flooz_depot_total_mensuel, $flooz_retrait_total_mensuel_nombre, $flooz_depot_total_mensuel_nombre],
                [$tmoney_retrait_total_mensuel, $tmoney_depot_total_mensuel, $tmoney_retrait_total_mensuel_nombre, $tmoney_depot_total_mensuel_nombre],
                [$ria_retrait_total_mensuel, $ria_depot_total_mensuel, $ria_retrait_total_annuel_nombre, $ria_depot_total_mensuel_nombre],
                [$western_union_retrait_total_mensuel, $western_union_depot_total_mensuel, $western_union_retrait_total_mensuel_nombre, $western_union_depot_total_mensuel_nombre],
                [$moneygram_retrait_total_mensuel, $moneygram_depot_total_mensuel, $moneygram_retrait_total_mensuel_nombre, $moneygram_depot_total_mensuel_nombre],
            ];

            //error_log($flooz_depot_total_mensuel);
            //error_log($flooz_retrait_total_mensuel);

        }
        /*for($i = 1; $i <= $mois ; $i++){
            global $index;
            $index  = $i;
            $GLOBALS['index'] = $i;

            $tmoney_depot_total_mensuel = 0;
            $tmoney_retrait_total_mensuel = 0;
            $tmoney_total_mensuel = 0;
            $transactions = Transactions::cursor()->filter(function($transaction){
                //error_log($GLOBALS['index']);
                return date_format(date_create($transaction['created_at']),'m') == $GLOBALS['index'] && date_format(date_create($transaction['created_at']),'Y') == date('Y') && $transaction->transaction_type['nom'] == 'tmoney';
            });
            foreach($transactions as $transaction){
                if($transaction->transaction_operation_type['nom'] == 'depot' ){
                    $tmoney_depot_total_mensuel = $tmoney_depot_total_mensuel + $transaction['montant'];
                    continue;
                }
                if($transaction->transaction_operation_type['nom'] == 'retrait' ){
                    $tmoney_retrait_total_mensuel = $tmoney_retrait_total_mensuel + $transaction['montant'];
                    continue;
                }
            }
            $tmoney_depot_total_annuel =  $tmoney_depot_total_annuel +  $tmoney_depot_total_mensuel ;
            $tmoney_retrait_total_annuel =  $tmoney_retrait_total_annuel +  $tmoney_retrait_total_mensuel ;

            $flooz_depot_total_mensuel = 0;
            $flooz_retrait_total_mensuel = 0;
            $flooz_total_mensuel = 0;
            $transactions = Transactions::cursor()->filter(function($transaction){
                return date_format(date_create($transaction['created_at']),'m') == $GLOBALS['index'] && date_format(date_create($transaction['created_at']),'Y') == date('Y') && $transaction->transaction_type['nom'] == 'flooz';
            });
            foreach($transactions as $transaction){
                if($transaction->transaction_operation_type['nom'] == 'depot' ){
                    $flooz_depot_total_mensuel = $flooz_depot_total_mensuel + $transaction['montant'];
                    continue;
                }
                if($transaction->transaction_operation_type['nom'] == 'retrait' ){
                    $flooz_retrait_total_mensuel = $flooz_retrait_total_mensuel + $transaction['montant'];
                    continue;
                }
            }

            $flooz_depot_total_annuel =  $flooz_depot_total_annuel +  $flooz_depot_total_mensuel ;
            $flooz_retrait_total_annuel =  $flooz_retrait_total_annuel +  $flooz_retrait_total_mensuel ;

            $ria_depot_total_mensuel = 0;
            $ria_retrait_total_mensuel = 0;
            $ria_total_mensuel = 0;
            $transactions = Transactions::cursor()->filter(function($transaction){
                return date_format(date_create($transaction['created_at']),'m') == $GLOBALS['index'] && date_format(date_create($transaction['created_at']),'Y') == date('Y') && $transaction->transaction_type['nom'] == 'ria';
            });
            foreach($transactions as $transaction){
                if($transaction->transaction_operation_type['nom'] == 'depot' ){
                    $ria_depot_total_mensuel = $ria_depot_total_mensuel + $transaction['montant'];
                    continue;
                }
                if($transaction->transaction_operation_type['nom'] == 'retrait' ){
                    $ria_retrait_total_mensuel = $ria_retrait_total_mensuel + $transaction['montant'];
                    continue;
                }
            }
            $ria_depot_total_annuel =  $ria_depot_total_annuel +  $ria_depot_total_mensuel ;
            $ria_retrait_total_annuel =  $ria_retrait_total_annuel +  $ria_retrait_total_mensuel ;


            $western_union_depot_total_mensuel = 0;
            $western_union_retrait_total_mensuel = 0;
            $western_union_total_mensuel = 0;
            $transactions = Transactions::cursor()->filter(function($transaction){
                return date_format(date_create($transaction['created_at']),'m') == $GLOBALS['index'] && date_format(date_create($transaction['created_at']),'Y') == date('Y') && $transaction->transaction_type['nom'] == 'western union';
            });
            foreach($transactions as $transaction){
                if($transaction->transaction_operation_type['nom'] == 'depot' ){
                    $western_union_depot_total_mensuel = $western_union_depot_total_mensuel + $transaction['montant'];
                    continue;
                }
                if($transaction->transaction_operation_type['nom'] == 'retrait' ){
                    $western_union_retrait_total_mensuel = $western_union_retrait_total_mensuel + $transaction['montant'];
                    continue;
                }
            }
            $western_union_depot_total_annuel =  $western_union_depot_total_annuel +  $western_union_depot_total_mensuel ;
            $western_union_retrait_total_annuel =  $western_union_retrait_total_annuel +  $western_union_retrait_total_mensuel ;

            $moneygram_depot_total_mensuel = 0;
            $moneygram_retrait_total_mensuel = 0;
            $moneygram_union_total_mensuel = 0;
            $transactions = Transactions::cursor()->filter(function($transaction){
                return date_format(date_create($transaction['created_at']),'m') == $GLOBALS['index'] && date_format(date_create($transaction['created_at']),'Y') == date('Y') && $transaction->transaction_type['nom'] == 'moneygram';
            });
            foreach($transactions as $transaction){
                if($transaction->transaction_operation_type['nom'] == 'depot' ){
                    $moneygram_depot_total_mensuel = $moneygram_depot_total_mensuel + $transaction['montant'];
                    continue;
                }
                if($transaction->transaction_operation_type['nom'] == 'retrait' ){
                    $moneygram_retrait_total_mensuel = $moneygram_retrait_total_mensuel + $transaction['montant'];
                    continue;
                }
            }

            $moneygram_depot_total_annuel =  $moneygram_depot_total_annuel +  $moneygram_depot_total_mensuel ;
            $moneygram_retrait_total_annuel =  $moneygram_retrait_total_annuel +  $moneygram_retrait_total_mensuel ;

            
            $data [$i] = [
                $i,
                [$flooz_retrait_total_mensuel,$flooz_depot_total_mensuel],
                [$tmoney_retrait_total_mensuel,$tmoney_depot_total_mensuel],
                [$ria_retrait_total_mensuel,$ria_depot_total_mensuel],
                [$western_union_retrait_total_mensuel,$western_union_depot_total_mensuel],
                [$moneygram_retrait_total_mensuel,$moneygram_depot_total_mensuel],
            ];

            //error_log($flooz_depot_total_mensuel);
            //error_log($flooz_retrait_total_mensuel);
            
        }*/
        $data2 = [
            'flooz' => [$flooz_retrait_total_annuel, $flooz_depot_total_annuel, $flooz_retrait_total_annuel_nombre, $flooz_depot_total_annuel_nombre],
            'tmoney' => [$tmoney_retrait_total_annuel, $tmoney_depot_total_annuel, $tmoney_retrait_total_annuel_nombre, $tmoney_depot_total_annuel_nombre],
            'ria' => [$ria_retrait_total_annuel, $ria_depot_total_annuel, $ria_retrait_total_annuel_nombre, $ria_depot_total_annuel_nombre],
            'western_union' => [$western_union_retrait_total_annuel, $western_union_depot_total_annuel, $western_union_retrait_total_annuel_nombre, $western_union_depot_total_annuel_nombre],
            'moneygram' => [$moneygram_retrait_total_annuel, $moneygram_depot_total_annuel, $moneygram_retrait_total_annuel_nombre, $moneygram_depot_total_annuel_nombre],
        ];

        $trans = Transaction::cursor()->filter(function ($transaction) {
            return date_format(date_create($transaction['created_at']), 'Y') == date('Y') && $transaction['deleted'] == false;
        });

        return view('statistique_annuel_nombre', [
            'data' => $data,
            'data2' => $data2,
            'transaction_nombre_total' => $trans->count(),
        ]);
    }



    public function create_transaction(Request $request)
    {
        $request->session()->remove('save');
        $request->session()->remove('error');
        if ($request->isMethod('post')) {
            $type = TransactionType::where('nom', $request->input('type'))->first();
            $user = auth()->user();
            $types = TransactionType::all();
            $type_operation = TransactionOperationType::where('nom', $request->input('type_operation'))->first();
            //error_log($type_operation['nom']);
            //error_log($type['id']);
            $user = auth()->user();

            if ($type['nom'] == 'flooz') {
                if(!(Str::startsWith($request->input('numero'),'99') || Str::startsWith($request->input('numero'),'98') || Str::startsWith($request->input('numero'),'97') || Str::startsWith($request->input('numero'),'96'))){
                    $request->session()->flash('route_name', 'Enregistrer une Transaction');
                    $request->session()->flash('error', 'Le numero saisi n\'est pas un numero Moov');
                    $request->session()->remove('save');
                    return view('create_transaction');
                }

            }
            if ($type['nom'] == 'tmoney') {
                if(!(Str::startsWith($request->input('numero'),'90') || Str::startsWith($request->input('numero'),'91') || Str::startsWith($request->input('numero'),'92') || Str::startsWith($request->input('numero'),'93') || Str::startsWith($request->input('numero'),'70'))){
                $request->session()->flash('route_name', 'Enregistrer une Transaction');
                $request->session()->flash('error', 'Le numero saisi n\'est pas un numero Togocom');
                $request->session()->remove('save');
                return view('create_transaction');
                }
            }

            if ($type['nom'] == 'flooz' || $type['nom'] == 'tmoney') {
                $compte = Compte::where('type_compte', $type['nom'])->get()[0];
                if ($type_operation['nom'] == 'depot') {
                    if ($compte['solde'] < $request->input('montant')) {
                        $request->session()->flash('route_name', 'Enregistrer une Transaction');
                        $request->session()->flash('error', 'Le solde est insuffisant pour effectuer le depot');
                        $request->session()->remove('save');
                        return view('create_transaction');
                    }
                    $compte['solde'] -= $request->input('montant');
                    //$compte->save();
                }
                if ($type_operation['nom'] == 'retrait') {

                    $compte['solde'] += $request->input('montant');
                    //$compte->save();
                }
                $compte->save();
            
            $numero = substr($request->input('numero'),0,2).' '.substr($request->input('numero'),2,2).' '.substr($request->input('numero'),4,2).' '.substr($request->input('numero'),6,2);
            //dd($numero);
            $transaction = Transaction::create([
                'transaction_type_id' => $type['id'],
                'transaction_operation_type_id' => $type_operation['id'],
                'montant' => $request->input('montant'),
                'numero' => $numero,
                'log_id' => 0,
                'user_id' => $user['id'],
                'compte_id' => $compte['id'],
            ]);
            $log = Log::create([
                'user_id' => $user['id'],
                'type_activite' => 'ENREGISTREMENT TRANSACTION',
                'transaction_id' => $transaction['id'],
            ]);

            $transaction['log_id'] = $log['id'];
            $transaction->save();


            //error_log($transaction);
            //error_log($log);
            $request->session()->flash('route_name', 'Enregistrer une Transaction');
            $request->session()->flash('save', true);
            $request->session()->remove('error');
            return view('create_transaction');
        }

        }
        $request->session()->flash('route_name', 'Enregistrer une Transaction');
        return view('create_transaction');
    }

    public function modify_transaction()
    {
        return view('modify_transaction');
    }


    public function liste_transaction(Request $request)
    {
        $request->session()->remove('date_debut');
        $request->session()->remove('date_fin');
        $transactions = Transaction::orderBy('created_at', 'desc')->where('deleted',false)->get();
        $request->session()->flash('route_name', 'Liste Transaction');

        if(($request->input('date_debut') != null && $request->input('date_debut') != '') && ($request->input('date_fin') != null && $request->input('date_debut') != '') ){
            $request->session()->flash('date_debut',$request->input('date_debut'));
            $request->session()->flash('date_fin',$request->input('date_fin'));
            $transactions = Transaction::whereBetween('created_at',[$request->input('date_debut'),$request->input('date_fin')])->where('deleted',false)->orderBy('created_at','desc')->get();
        }

        if($request->input('archive') != null){
            $transactions = Transaction::orderBy('created_at', 'desc')->where('deleted',true)->get();
            $request->session()->flash('route_name', 'Liste Transaction Archive');
            return view('liste_transaction', ['arc'=>true,'transactions' => $transactions])->with('route_name', 'Liste Transaction');
        }
        
        //$request->session()->flash('route_name', 'Liste Transaction');
        return view('liste_transaction', ['transactions' => $transactions])->with('route_name', 'Liste Transaction');
        ;
    }



    public function statistique(Request $request)
    {


        //error_log('XXXXXXXXXXXXXXXXXXXXXX');



        $flooz = TransactionType::where('nom', 'flooz')->get()[0];
        $tmoney = TransactionType::where('nom', 'tmoney')->get()[0];
        $western_union = TransactionType::where('nom', 'western union ')->get()[0];
        $ria = TransactionType::where('nom', 'ria')->get()[0];
        $moneygram = TransactionType::where('nom', 'moneygram')->get()[0];

        $flooz->transactions = $flooz->transactions->where('created_at', '>=', date('Y-m-d'))->where('deleted', false);
        $tmoney->transactions = $tmoney->transactions->where('created_at', '>=', date('Y-m-d'))->where('deleted', false);
        $western_union->transactions = $western_union->transactions->where('created_at', '>=', date('Y-m-d'))->where('deleted', false);
        $ria->transactions = $ria->transactions->where('created_at', '>=', date('Y-m-d'))->where('deleted', false);
        $moneygram->transactions = $moneygram->transactions->where('created_at', '>=', date('Y-m-d'))->where('deleted', false);

        if (($request->input('date_debut') != null && $request->input('date_debut') != '') && ($request->input('date_fin') != null && $request->input('date_fin') != '')) {
            //error_log(222222222222222222222);
            //$flooz = TransactionType::whereBetween('nom', 'flooz')->get()[0];
            //$flooz->transactions = $flooz->transactions->whereBetween('created_at', [$request->input('date_debut'),$request->input('date_fin')]);

            $flooz = TransactionType::where('nom', 'flooz')->get()[0];
            $tmoney = TransactionType::where('nom', 'tmoney')->get()[0];
            $western_union = TransactionType::where('nom', 'western union ')->get()[0];
            $ria = TransactionType::where('nom', 'ria')->get()[0];
            $moneygram = TransactionType::where('nom', 'moneygram')->get()[0];

            $flooz->transactions = $flooz->transactions->whereBetween('created_at', [$request->input('date_debut'), $request->input('date_fin')])->where('deleted', false);
            $tmoney->transactions = $tmoney->transactions->whereBetween('created_at', [$request->input('date_debut'), $request->input('date_fin')])->where('deleted', false);
            $western_union->transactions = $western_union->transactions->whereBetween('created_at', [$request->input('date_debut'), $request->input('date_fin')])->where('deleted', false);
            $ria->transactions = $ria->transactions->whereBetween('created_at', [$request->input('date_debut'), $request->input('date_fin')])->where('deleted', false);
            $moneygram->transactions = $moneygram->transactions->whereBetween('created_at', [$request->input('date_debut'), $request->input('date_fin')])->where('deleted', false);
        }

        $data = [];


        $flooz_nombre_retrait = 0;
        $flooz_nombre_depot = 0;
        $flooz_montant_total_retrait = 0;
        $flooz_montant_total_depot = 0;
        foreach ($flooz->transactions as $transaction) {
            //error_log($transaction->transaction_operation_type['nom'] == 'depot');
            //error_log($transaction->transaction_operation_type['nom']);
            if ($transaction->transaction_operation_type['nom'] == 'depot') {
                //error_log($transaction->transaction_operation_type['nom']);
                $flooz_nombre_depot += 1;
                $flooz_montant_total_depot += $transaction['montant'];
                continue;
            }
            if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                $flooz_nombre_retrait += 1;
                $flooz_montant_total_retrait += $transaction['montant'];
                continue;
            }
        }



        $tmoney_nombre_retrait = 0;
        $tmoney_nombre_depot = 0;
        $tmoney_montant_total_retrait = 0;
        $tmoney_montant_total_depot = 0;
        foreach ($tmoney->transactions as $transaction) {
            if ($transaction->transaction_operation_type['nom'] == 'depot') {
                $tmoney_nombre_depot += 1;
                $tmoney_montant_total_depot += $transaction['montant'];
                continue;
            }
            if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                $tmoney_nombre_retrait += 1;
                $tmoney_montant_total_retrait += $transaction['montant'];
                continue;
            }
        }



        $ria_nombre_retrait = 0;
        $ria_nombre_depot = 0;
        $ria_montant_total_retrait = 0;
        $ria_montant_total_depot = 0;
        foreach ($ria->transactions as $transaction) {
            if ($transaction->transaction_operation_type['nom'] == 'depot') {
                $ria_nombre_depot += 1;
                $ria_montant_total_depot += $transaction['montant'];
                continue;
            }
            if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                $ria_nombre_retrait += 1;
                $ria_montant_total_retrait += $transaction['montant'];
                continue;
            }
        }

        $western_union_nombre_retrait = 0;
        $western_union_nombre_depot = 0;
        $western_union_montant_total_retrait = 0;
        $western_union_montant_total_depot = 0;
        foreach ($western_union->transactions as $transaction) {
            if ($transaction->transaction_operation_type['nom'] == 'depot') {
                $western_union_nombre_depot += 1;
                $western_union_montant_total_depot += $transaction['montant'];
                continue;
            }
            if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                $western_union_nombre_retrait += 1;
                $western_union_montant_total_retrait += $transaction['montant'];
                continue;
            }
        }


        $moneygram_nombre_retrait = 0;
        $moneygram_nombre_depot = 0;
        $moneygram_montant_total_retrait = 0;
        $moneygram_montant_total_depot = 0;
        //error_log($moneygram->transactions);
        foreach ($moneygram->transactions as $transaction) {
            if ($transaction->transaction_operation_type['nom'] == 'depot') {
                $moneygram_nombre_depot += 1;
                $moneygram_montant_total_depot += $transaction['montant'];
                continue;
            }
            if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                $moneygram_nombre_retrait += 1;
                $moneygram_montant_total_retrait += $transaction['montant'];
                continue;
            }
        }

        $data = [
            [
                $flooz_nombre_retrait,
                $tmoney_nombre_retrait,
                $ria_nombre_retrait,
                $western_union_nombre_retrait,
                $moneygram_nombre_retrait,

            ],
            [
                $flooz_nombre_depot,
                $tmoney_nombre_depot,
                $ria_nombre_depot,
                $western_union_nombre_depot,
                $moneygram_nombre_depot,
            ],
            [
                $flooz_montant_total_retrait,
                $tmoney_montant_total_retrait,
                $ria_montant_total_retrait,
                $western_union_montant_total_retrait,
                $moneygram_montant_total_retrait,
            ],
            [
                $flooz_montant_total_depot,
                $tmoney_montant_total_depot,
                $ria_montant_total_depot,
                $western_union_montant_total_depot,
                $moneygram_montant_total_depot,
            ],
            []
        ];

        if (($request->input('date_debut') != null && $request->input('date_debut') != '') && ($request->input('date_fin') != null && $request->input('date_fin') != '')) {
            return view('statistique', [
                'flooz' => $flooz,
                'tmoney' => $tmoney,
                'ria' => $ria,
                'western_union' => $western_union,
                'moneygram' => $moneygram,
                'date_debut' => $request->input('date_debut'),
                'date_fin' => $request->input('date_fin'),
                'data' => $data,
            ]);
        }

        $request->session()->flash('route_name', 'Statistique');
        return view('statistique', [
            'flooz' => $flooz,
            'tmoney' => $tmoney,
            'ria' => $ria,
            'western_union' => $western_union,
            'moneygram' => $moneygram,
            'data' => $data,
        ])->with('route_name', 'Statistique');
        ;


    }

    public function more_transaction(Request $request, $id)
    {
        $transaction = Transaction::find($id);
        $request->session()->flash('route_name', 'Transaction Detail');
        return view('more_transaction', ['transaction' => $transaction]);

    }

    public function recapitulatif(Request $request)
    {

        $flooz = TransactionType::where('nom', 'flooz')->get()[0];
        $tmoney = TransactionType::where('nom', 'tmoney')->get()[0];
        $western_union = TransactionType::where('nom', 'western union ')->get()[0];
        $ria = TransactionType::where('nom', 'ria')->get()[0];
        $moneygram = TransactionType::where('nom', 'moneygram')->get()[0];

        $flooz->transactions = $flooz->transactions->where('created_at', '>=', date('Y-m-d'))->where('deleted', false);
        $tmoney->transactions = $tmoney->transactions->where('created_at', '>=', date('Y-m-d'))->where('deleted', false);
        $western_union->transactions = $western_union->transactions->where('created_at', '>=', date('Y-m-d'))->where('deleted', false);
        $ria->transactions = $ria->transactions->where('created_at', '>=', date('Y-m-d'))->where('deleted', false);
        $moneygram->transactions = $moneygram->transactions->where('created_at', '>=', date('Y-m-d'))->where('deleted', false);

        $data = [];

        if (($request->input('date_debut') != null && $request->input('date_debut') != '') && ($request->input('date_fin') != null && $request->input('date_fin') != '')) {
            $flooz = TransactionType::where('nom', 'flooz')->get()[0];
            $tmoney = TransactionType::where('nom', 'tmoney')->get()[0];
            $western_union = TransactionType::where('nom', 'western union ')->get()[0];
            $ria = TransactionType::where('nom', 'ria')->get()[0];
            $moneygram = TransactionType::where('nom', 'moneygram')->get()[0];

            $flooz->transactions = $flooz->transactions->whereBetween('created_at', [$request->input('date_debut'), $request->input('date_fin')])->where('deleted', false);
            $tmoney->transactions = $tmoney->transactions->whereBetween('created_at', [$request->input('date_debut'), $request->input('date_fin')])->where('deleted', false);
            $western_union->transactions = $western_union->transactions->whereBetween('created_at', [$request->input('date_debut'), $request->input('date_fin')])->where('deleted', false);
            $ria->transactions = $ria->transactions->whereBetween('created_at', [$request->input('date_debut'), $request->input('date_fin')])->where('deleted', false);
            $moneygram->transactions = $moneygram->transactions->whereBetween('created_at', [$request->input('date_debut'), $request->input('date_fin')])->where('deleted', false);
        }


        $flooz_nombre_retrait = 0;
        $flooz_nombre_depot = 0;
        $flooz_montant_total_retrait = 0;
        $flooz_montant_total_depot = 0;
        foreach ($flooz->transactions as $transaction) {
            //error_log($transaction->transaction_operation_type['nom'] == 'depot');
            //error_log($transaction->transaction_operation_type['nom']);
            if ($transaction->transaction_operation_type['nom'] == 'depot') {
                //error_log($transaction->transaction_operation_type['nom']);
                $flooz_nombre_depot += 1;
                $flooz_montant_total_depot += $transaction['montant'];
                continue;
            }
            if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                $flooz_nombre_retrait += 1;
                $flooz_montant_total_retrait += $transaction['montant'];
                continue;
            }
        }



        $tmoney_nombre_retrait = 0;
        $tmoney_nombre_depot = 0;
        $tmoney_montant_total_retrait = 0;
        $tmoney_montant_total_depot = 0;
        foreach ($tmoney->transactions as $transaction) {
            if ($transaction->transaction_operation_type['nom'] == 'depot') {
                $tmoney_nombre_depot += 1;
                $tmoney_montant_total_depot += $transaction['montant'];
                continue;
            }
            if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                $tmoney_nombre_retrait += 1;
                $tmoney_montant_total_retrait += $transaction['montant'];
                continue;
            }
        }



        $ria_nombre_retrait = 0;
        $ria_nombre_depot = 0;
        $ria_montant_total_retrait = 0;
        $ria_montant_total_depot = 0;
        foreach ($ria->transactions as $transaction) {
            if ($transaction->transaction_operation_type['nom'] == 'depot') {
                $ria_nombre_depot += 1;
                $ria_montant_total_depot += $transaction['montant'];
                continue;
            }
            if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                $ria_nombre_retrait += 1;
                $ria_montant_total_retrait += $transaction['montant'];
                continue;
            }
        }

        $western_union_nombre_retrait = 0;
        $western_union_nombre_depot = 0;
        $western_union_montant_total_retrait = 0;
        $western_union_montant_total_depot = 0;
        foreach ($western_union->transactions as $transaction) {
            if ($transaction->transaction_operation_type['nom'] == 'depot') {
                $western_union_nombre_depot += 1;
                $western_union_montant_total_depot += $transaction['montant'];
                continue;
            }
            if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                $western_union_nombre_retrait += 1;
                $western_union_montant_total_retrait += $transaction['montant'];
                continue;
            }
        }


        $moneygram_nombre_retrait = 0;
        $moneygram_nombre_depot = 0;
        $moneygram_montant_total_retrait = 0;
        $moneygram_montant_total_depot = 0;
        //error_log($moneygram->transactions);
        foreach ($moneygram->transactions as $transaction) {
            if ($transaction->transaction_operation_type['nom'] == 'depot') {
                $moneygram_nombre_depot += 1;
                $moneygram_montant_total_depot += $transaction['montant'];
                continue;
            }
            if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                $moneygram_nombre_retrait += 1;
                $moneygram_montant_total_retrait += $transaction['montant'];
                continue;
            }
        }

        $data = [
            [
                $flooz_nombre_retrait,
                $tmoney_nombre_retrait,
                $ria_nombre_retrait,
                $western_union_nombre_retrait,
                $moneygram_nombre_retrait,

            ],
            [
                $flooz_nombre_depot,
                $tmoney_nombre_depot,
                $ria_nombre_depot,
                $western_union_nombre_depot,
                $moneygram_nombre_depot,
            ],
            [
                $flooz_montant_total_retrait,
                $tmoney_montant_total_retrait,
                $ria_montant_total_retrait,
                $western_union_montant_total_retrait,
                $moneygram_montant_total_retrait,
            ],
            [
                $flooz_montant_total_depot,
                $tmoney_montant_total_depot,
                $ria_montant_total_depot,
                $western_union_montant_total_depot,
                $moneygram_montant_total_depot,
            ],
            []
        ];
        //error_log('OOOOOOOOOOOO');
        if (($request->input('date_debut') != null && $request->input('date_debut') != '') && ($request->input('date_fin') != null && $request->input('date_fin') != '')) {
            return view(
                'recapitulatif',
                [
                    'western_union' => $western_union,
                    'flooz' => $flooz,
                    'tmoney' => $tmoney,
                    'ria' => $ria,

                    'moneygram' => $moneygram,
                    'date_debut' => $request->input('date_debut'),
                    'date_fin' => $request->input('date_fin'),
                    'data' => $data,
                ]
            );
        }
        return view(
            'recapitulatif',
            [
                'western_union' => $western_union,
                'flooz' => $flooz,
                'tmoney' => $tmoney,
                'ria' => $ria,

                'moneygram' => $moneygram,
                'data' => $data,
            ]
        );
    }

    public function recapitulatif_flooz(Request $request)
    {
        if (($request->input('date_debut') != null && $request->input('date_debut') != '') && ($request->input('date_fin') != null && $request->input('date_fin') != '')) {
            //error_log(222222222222222222222);
            $flooz = TransactionType::where('nom', 'flooz')->get()[0];
            $flooz->transactions = $flooz->transactions->whereBetween('created_at', [$request->input('date_debut'), $request->input('date_fin')])->where('deleted', false);
            $data = [];
            //error_log($flooz->transactions);
            $flooz_nombre_retrait = 0;
            $flooz_nombre_depot = 0;
            $flooz_montant_total_retrait = 0;
            $flooz_montant_total_depot = 0;
            foreach ($flooz->transactions as $transaction) {
                //error_log($transaction->transaction_operation_type['nom'] == 'depot');
                //error_log($transaction->transaction_operation_type['nom']);
                if ($transaction->transaction_operation_type['nom'] == 'depot') {
                    //error_log($transaction->transaction_operation_type['nom']);
                    $flooz_nombre_depot += 1;
                    $flooz_montant_total_depot += $transaction['montant'];
                    continue;
                }
                if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                    $flooz_nombre_retrait += 1;
                    $flooz_montant_total_retrait += $transaction['montant'];
                    continue;
                }
            }


            return view(
                'recapitulatif_flooz',
                [
                    'flooz' => $flooz,
                    'flooz_nombre_retrait' => $flooz_nombre_retrait,
                    'flooz_nombre_depot' => $flooz_nombre_depot,
                    'flooz_montant_total_retrait' => $flooz_montant_total_retrait,
                    'flooz_montant_total_depot' => $flooz_montant_total_depot,
                    'data' => $data,
                    'date_debut' => $request->input('date_debut'),
                    'date_fin' => $request->input('date_fin'),
                    'peride' => 'mois',

                ]
            );
        }
        $flooz = TransactionType::where('nom', 'flooz')->get()[0];
        $flooz->transactions = $flooz->transactions->where('created_at', '>=', date('Y-m-d'))->where('deleted', false);
        $data = [];

        $flooz_nombre_retrait = 0;
        $flooz_nombre_depot = 0;
        $flooz_montant_total_retrait = 0;
        $flooz_montant_total_depot = 0;
        foreach ($flooz->transactions as $transaction) {
            //error_log($transaction->transaction_operation_type['nom'] == 'depot');
            //error_log($transaction->transaction_operation_type['nom']);
            if ($transaction->transaction_operation_type['nom'] == 'depot') {
                //error_log($transaction->transaction_operation_type['nom']);
                $flooz_nombre_depot += 1;
                $flooz_montant_total_depot += $transaction['montant'];
                continue;
            }
            if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                $flooz_nombre_retrait += 1;
                $flooz_montant_total_retrait += $transaction['montant'];
                continue;
            }
        }


        return view(
            'recapitulatif_flooz',
            [
                'flooz' => $flooz,
                'flooz_nombre_retrait' => $flooz_nombre_retrait,
                'flooz_nombre_depot' => $flooz_nombre_depot,
                'flooz_montant_total_retrait' => $flooz_montant_total_retrait,
                'flooz_montant_total_depot' => $flooz_montant_total_depot,
                'data' => $data,
            ]
        );
    }

    public function recapitulatif_tmoney(Request $request)
    {
        if (($request->input('date_debut') != null && $request->input('date_debut') != '') && ($request->input('date_fin') != null && $request->input('date_fin') != '')) {
            //error_log(222222222222222222222);
            $tmoney = TransactionType::where('nom', 'tmoney')->get()[0];
            $tmoney->transactions = $tmoney->transactions->whereBetween('created_at', [$request->input('date_debut'), $request->input('date_fin')])->where('deleted', false);
            $data = [];
            //error_log($flooz->transactions);
            $tmoney_nombre_retrait = 0;
            $tmoney_nombre_depot = 0;
            $tmoney_montant_total_retrait = 0;
            $tmoney_montant_total_depot = 0;
            foreach ($tmoney->transactions as $transaction) {
                //error_log($transaction->transaction_operation_type['nom'] == 'depot');
                //error_log($transaction->transaction_operation_type['nom']);
                if ($transaction->transaction_operation_type['nom'] == 'depot') {
                    //error_log($transaction->transaction_operation_type['nom']);
                    $tmoney_nombre_depot += 1;
                    $tmoney_montant_total_depot += $transaction['montant'];
                    continue;
                }
                if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                    $tmoney_nombre_retrait += 1;
                    $tmoney_montant_total_retrait += $transaction['montant'];
                    continue;
                }
            }


            return view(
                'recapitulatif_tmoney',

                [
                    'tmoney' => $tmoney,
                    'tmoney_nombre_retrait' => $tmoney_nombre_retrait,
                    'tmoney_nombre_depot' => $tmoney_nombre_depot,
                    'tmoney_montant_total_retrait' => $tmoney_montant_total_retrait,
                    'tmoney_montant_total_depot' => $tmoney_montant_total_depot,
                    'data' => $data,
                    'date_debut' => $request->input('date_debut'),
                    'date_fin' => $request->input('date_fin'),
                ]
            );
        }

        $tmoney = TransactionType::where('nom', 'tmoney')->get()[0];
        $tmoney->transactions = $tmoney->transactions->where('created_at', '>=', date('Y-m-d'))->where('deleted', false);
        $data = [];

        $tmoney_nombre_retrait = 0;
        $tmoney_nombre_depot = 0;
        $tmoney_montant_total_retrait = 0;
        $tmoney_montant_total_depot = 0;
        foreach ($tmoney->transactions as $transaction) {
            //error_log($transaction->transaction_operation_type['nom'] == 'depot');
            //error_log($transaction->transaction_operation_type['nom']);
            if ($transaction->transaction_operation_type['nom'] == 'depot') {
                //error_log($transaction->transaction_operation_type['nom']);
                $tmoney_nombre_depot += 1;
                $tmoney_montant_total_depot += $transaction['montant'];
                continue;
            }
            if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                $tmoney_nombre_retrait += 1;
                $tmoney_montant_total_retrait += $transaction['montant'];
                continue;
            }
        }


        return view(
            'recapitulatif_tmoney',
            [
                'tmoney' => $tmoney,
                'tmoney_nombre_retrait' => $tmoney_nombre_retrait,
                'tmoney_nombre_depot' => $tmoney_nombre_depot,
                'tmoney_montant_total_retrait' => $tmoney_montant_total_retrait,
                'tmoney_montant_total_depot' => $tmoney_montant_total_depot,
                'data' => $data,
            ]
        );
    }

    public function recapitulatif_ria(Request $request)
    {
        if (($request->input('date_debut') != null && $request->input('date_debut') != '') && ($request->input('date_fin') != null && $request->input('date_fin') != '')) {
            //error_log(222222222222222222222);
            $ria = TransactionType::where('nom', 'ria')->get()[0];
            $ria->transactions = $ria->transactions->whereBetween('created_at', [$request->input('date_debut'), $request->input('date_fin')])->where('deleted', false);
            $data = [];
            //error_log($flooz->transactions);
            $ria_nombre_retrait = 0;
            $ria_nombre_depot = 0;
            $ria_montant_total_retrait = 0;
            $ria_montant_total_depot = 0;
            foreach ($ria->transactions as $transaction) {
                //error_log($transaction->transaction_operation_type['nom'] == 'depot');
                //error_log($transaction->transaction_operation_type['nom']);
                if ($transaction->transaction_operation_type['nom'] == 'depot') {
                    //error_log($transaction->transaction_operation_type['nom']);
                    $ria_nombre_depot += 1;
                    $ria_montant_total_depot += $transaction['montant'];
                    continue;
                }
                if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                    $ria_nombre_retrait += 1;
                    $ria_montant_total_retrait += $transaction['montant'];
                    continue;
                }
            }


            return view(
                'recapitulatif_ria',

                [
                    'ria' => $ria,
                    'ria_nombre_retrait' => $ria_nombre_retrait,
                    'ria_nombre_depot' => $ria_nombre_depot,
                    'ria_montant_total_retrait' => $ria_montant_total_retrait,
                    'ria_montant_total_depot' => $ria_montant_total_depot,
                    'data' => $data,
                    'date_debut' => $request->input('date_debut'),
                    'date_fin' => $request->input('date_fin'),
                ]
            );
        }

        $ria = TransactionType::where('nom', 'ria')->get()[0];
        $ria->transactions = $ria->transactions->where('created_at', '>=', date('Y-m-d'))->where('deleted', false);
        $data = [];

        $ria_nombre_retrait = 0;
        $ria_nombre_depot = 0;
        $ria_montant_total_retrait = 0;
        $ria_montant_total_depot = 0;
        foreach ($ria->transactions as $transaction) {
            //error_log($transaction->transaction_operation_type['nom'] == 'depot');
            //error_log($transaction->transaction_operation_type['nom']);
            if ($transaction->transaction_operation_type['nom'] == 'depot') {
                //error_log($transaction->transaction_operation_type['nom']);
                $ria_nombre_depot += 1;
                $ria_montant_total_depot += $transaction['montant'];
                continue;
            }
            if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                $ria_nombre_retrait += 1;
                $ria_montant_total_retrait += $transaction['montant'];
                continue;
            }
        }


        return view(
            'recapitulatif_ria',
            [
                'ria' => $ria,
                'ria_nombre_retrait' => $ria_nombre_retrait,
                'ria_nombre_depot' => $ria_nombre_depot,
                'ria_montant_total_retrait' => $ria_montant_total_retrait,
                'ria_montant_total_depot' => $ria_montant_total_depot,
                'data' => $data,
            ]
        );
    }

    public function recapitulatif_western_union(Request $request)
    {

        if (($request->input('date_debut') != null && $request->input('date_debut') != '') && ($request->input('date_fin') != null && $request->input('date_fin') != '')) {
            //error_log(222222222222222222222);
            $western_union = TransactionType::where('nom', 'western union')->get()[0];
            $western_union->transactions = $western_union->transactions->whereBetween('created_at', [$request->input('date_debut'), $request->input('date_fin')])->where('deleted', false);
            $data = [];
            //error_log($flooz->transactions);
            $western_union_nombre_retrait = 0;
            $western_union_nombre_depot = 0;
            $western_union_montant_total_retrait = 0;
            $western_union_montant_total_depot = 0;
            foreach ($western_union->transactions as $transaction) {
                //error_log($transaction->transaction_operation_type['nom'] == 'depot');
                //error_log($transaction->transaction_operation_type['nom']);
                if ($transaction->transaction_operation_type['nom'] == 'depot') {
                    //error_log($transaction->transaction_operation_type['nom']);
                    $western_union_nombre_depot += 1;
                    $western_union_montant_total_depot += $transaction['montant'];
                    continue;
                }
                if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                    $western_union_nombre_retrait += 1;
                    $western_union_montant_total_retrait += $transaction['montant'];
                    continue;
                }
            }


            return view(
                'recapitulatif_western_union',

                [
                    'western_union' => $western_union,
                    'western_union_nombre_retrait' => $western_union_nombre_retrait,
                    'western_union_nombre_depot' => $western_union_nombre_depot,
                    'western_union_montant_total_retrait' => $western_union_montant_total_retrait,
                    'western_union_montant_total_depot' => $western_union_montant_total_depot,
                    'data' => $data,
                    'date_debut' => $request->input('date_debut'),
                    'date_fin' => $request->input('date_fin'),
                ]
            );
        }

        $western_union = TransactionType::where('nom', 'western union')->get()[0];
        $western_union->transactions = $western_union->transactions->where('created_at', '>=', date('Y-m-d'))->where('deleted', false);
        $data = [];

        $western_union_nombre_retrait = 0;
        $western_union_nombre_depot = 0;
        $western_union_montant_total_retrait = 0;
        $western_union_montant_total_depot = 0;
        foreach ($western_union->transactions as $transaction) {
            //error_log($transaction->transaction_operation_type['nom'] == 'depot');
            //error_log($transaction->transaction_operation_type['nom']);
            if ($transaction->transaction_operation_type['nom'] == 'depot') {
                //error_log($transaction->transaction_operation_type['nom']);
                $western_union_nombre_depot += 1;
                $western_union_montant_total_depot += $transaction['montant'];
                continue;
            }
            if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                $western_union_nombre_retrait += 1;
                $western_union_montant_total_retrait += $transaction['montant'];
                continue;
            }
        }


        return view(
            'recapitulatif_western_union',
            [
                'western_union' => $western_union,
                'western_union_nombre_retrait' => $western_union_nombre_retrait,
                'western_union_nombre_depot' => $western_union_nombre_depot,
                'western_union_montant_total_retrait' => $western_union_montant_total_retrait,
                'western_union_montant_total_depot' => $western_union_montant_total_depot,
                'data' => $data,
            ]
        );
    }
    public function recapitulatif_moneygram(Request $request)
    {
        if (($request->input('date_debut') != null && $request->input('date_debut') != '') && ($request->input('date_fin') != null && $request->input('date_fin') != '')) {
            //error_log(222222222222222222222);
            $moneygram = TransactionType::where('nom', 'moneygram')->get()[0];
            $moneygram->transactions = $moneygram->transactions->whereBetween('created_at', [$request->input('date_debut'), $request->input('date_fin')])->where('deleted', false);
            $data = [];
            //error_log($flooz->transactions);
            $moneygram_nombre_retrait = 0;
            $moneygram_nombre_depot = 0;
            $moneygram_montant_total_retrait = 0;
            $moneygram_montant_total_depot = 0;
            foreach ($moneygram->transactions as $transaction) {
                //error_log($transaction->transaction_operation_type['nom'] == 'depot');
                //error_log($transaction->transaction_operation_type['nom']);
                if ($transaction->transaction_operation_type['nom'] == 'depot') {
                    //error_log($transaction->transaction_operation_type['nom']);
                    $moneygram_nombre_depot += 1;
                    $moneygram_montant_total_depot += $transaction['montant'];
                    continue;
                }
                if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                    $moneygram_nombre_retrait += 1;
                    $moneygram_montant_total_retrait += $transaction['montant'];
                    continue;
                }
            }


            return view(
                'recapitulatif_moneygram',

                [
                    'moneygram' => $moneygram,
                    'moneygram_nombre_retrait' => $moneygram_nombre_retrait,
                    'moneygram_nombre_depot' => $moneygram_nombre_depot,
                    'moneygram_montant_total_retrait' => $moneygram_montant_total_retrait,
                    'moneygram_montant_total_depot' => $moneygram_montant_total_depot,
                    'data' => $data,
                    'date_debut' => $request->input('date_debut'),
                    'date_fin' => $request->input('date_fin'),
                ]
            );
        }

        $moneygram = TransactionType::where('nom', 'moneygram')->get()[0];
        $moneygram->transactions = $moneygram->transactions->where('created_at', '>=', date('Y-m-d'))->where('deleted', false);
        $data = [];

        $moneygram_nombre_retrait = 0;
        $moneygram_nombre_depot = 0;
        $moneygram_montant_total_retrait = 0;
        $moneygram_montant_total_depot = 0;
        foreach ($moneygram->transactions as $transaction) {
            //error_log($transaction->transaction_operation_type['nom'] == 'depot');
            //error_log($transaction->transaction_operation_type['nom']);
            if ($transaction->transaction_operation_type['nom'] == 'depot') {
                //error_log($transaction->transaction_operation_type['nom']);
                $moneygram_nombre_depot += 1;
                $moneygram_montant_total_depot += $transaction['montant'];
                continue;
            }
            if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                $moneygram_nombre_retrait += 1;
                $moneygram_montant_total_retrait += $transaction['montant'];
                continue;
            }
        }


        return view(
            'recapitulatif_moneygram',
            [
                'moneygram' => $moneygram,
                'moneygram_nombre_retrait' => $moneygram_nombre_retrait,
                'moneygram_nombre_depot' => $moneygram_nombre_depot,
                'moneygram_montant_total_retrait' => $moneygram_montant_total_retrait,
                'moneygram_montant_total_depot' => $moneygram_montant_total_depot,
                'data' => $data,
            ]
        );
    }
    public function login(Request $request)
    {
        $admin = User::where('type_admin', 0)->get();
        //error_log($admin->count());
        //error_log($admin);
        if ($admin->count() == 0) {
            return redirect('register');
        }
        if ($request->isMethod('post')) {
            /*$user = User::where('email',$request->input('email'))->first();
            //error_log($user);
            if($user != null){
                if($user['password'] == $request->input('password')){
                    $log = Log::create([
                        'user_id' => $user['id'],
                        'type_activite'=>'CONNEXION',
                    ]);
                    auth()->login($user);
                    return redirect('/dashboard');
                }
                else{
                    $request->session()->flash('message','Mot de Pass Incorrect');
                    return redirect('/login')->with('message','Mot de Pass Incorrect');
                }
            }
            else{
                $request->session()->flash('message','Identifiants Incorrect');
                return redirect('/login')->with('message','Identifiants Incorrect');
            }*/

            /*if($request->input('email') == 'root@gmail.com' && $request->input('password') == 'remake2023' ){
                
            }*/
            $user = User::where('email', $request->input('email'))->first();
            if ($user == null || $user['deleted'] == true) {
                //error_log($user['deleted']);
                return redirect('/login')->with('message', 'Identifiants Incorrect');
            }
            /*if ($user != null && $user['first_time'] == true) {
                //error_log($user['deleted']);
                return redirect('/change_password');
            }*/
            if (
                auth()->attempt([
                    'email' => $request->input('email'),
                    'password' => $request->input('password'),
                ])
            ) {


                $request->session()->regenerate();
                $user = auth()->user();
                $log = Log::create([
                    'user_id' => $user['id'],
                    'type_activite' => 'CONNEXION',
                ]);
                if ($user['first_time'] == true) {
                    //error_log($user['deleted']);
                    $request->session()->put('id',$user['id']);
                    return redirect('/change_password');
                }
                return redirect('/dashboard');
            } else {
                return redirect('/login')->with('message', 'Identifiants Incorrect');
            }
        }
        return view('login');
    }

    public function logout(Request $request)
    {
        $user = auth()->user();
        $log = Log::create([
            'user_id' => $user['id'],
            'type_activite' => 'DECONNEXION',
        ]);
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function liste_log(Request $request)
    {
        $request->session()->flash('route_name', 'journal des Transactions');
        $logs = Log::orderBy('created_at', 'desc')->get();

        $logs = Log::orderBy('created_at', 'desc')->where('transaction_id', '!=', null)->get();
        //error_log($logs[0]->transactions);
        //error_log($logs);
        foreach ($logs as $l ) {
            error_log($l->transaction);
        }
        return view('liste_log', ['logs' => $logs]);
    }


    public function liste_log_activite(Request $request)
    {
        $request->session()->flash('route_name', 'journal des Activites');
        $logs = Log::orderBy('created_at', 'desc')->where('transaction_id', null)->get();


        
        return view('liste_log_activite', ['logs' => $logs]);
    }

    public function more_log(Request $request, $id)
    {
        $request->session()->flash('route_name', 'Journal Detail');
        $log = Log::find($id);
        return view('more_log', ['log' => $log]);
    }

    public function liste_admin(Request $request)
    {
        $users = User::all();
        return view('liste_admin', ['users' => $users]);
    }

    public function more_admin($id)
    {
        $user = User::find($id);
        $logs = Log::where('user_id', $user['id'])->orderBy('created_at', 'DESC')->get();
        $transactions = Transaction::where('user_id', $user['id'])->orderBy('created_at', 'DESC')->get();
        return view('more_admin', ['user' => $user, 'transactions' => $transactions, 'logs' => $logs]);
    }

    public function create_admin(Request $request)
    {
        $request->session()->remove('save');
        $request->session()->remove('error');
        $request->session()->flash('route_name', 'Enregistrer un Administrateur');
        if ($request->isMethod('post')) {

            $user = User::where('email',$request->input('email'))->get();
            if($user->count() != 0){
                $request->session()->flash('error', "l'address email est deja utilisee");
                return view('create_admin', );
            }

            $password = Str::random(10);
            

            $data = [
                'title' => 'AdminLTE:Mot de pass',
                'body' => 'Voici votre mot de pass par defaut: <b></b> ',
                'password' => $password,
            ];
            try {
                //code...
                Mail::to($request->input('email'))->send(new PasswordMail($data));
            } catch (\Throwable $th) {
                //throw $th;
                error_log($th);
                $request->session()->flash('error', "Une erreur est survenue,veuillez ressayer");
                return view('password', );
                
            }
            

            $user = User::create([
                'nom' => $request->input('nom'),
                'prenom' => $request->input('prenom'),
                'email' => $request->input('email'),
                'password' => $password,
                'type_admin' => $request->input('type_admin'),
            ]);
            $log = Log::create([
                'user_id' => auth()->user()['id'],
                'type_activite' => 'ENREGISTREMENT ADMINISTRATEUR',
                'transaction_id' => null,
            ]);


            //error_log($transaction);
            //error_log($log);

            $request->session()->flash('save', true);
            return view('create_admin', );
        }
        return view('create_admin');
    }

    public function t()
    {
        return view('t');
    }

    public function delete_admin(Request $request, $id)
    {

        $user = User::find($id);
        if ($user == null) {
            abort(404);
            
        }
        if ($request->isMethod('post')) {
            $user['deleted'] = true;
            $user->save();
            return redirect('/liste_admin');
        }
        return view('delete_admin', ['user' => $user]);
    }

    public function delete_transaction(Request $request, $id)
    {
        $transaction = Transaction::find($id);
        if ($transaction == null) {
            abort(404);
        }
        if ($transaction['deleted'] == true) {
            return back();
        }

        if ($request->isMethod('post')) {
            if ($transaction->transaction_type['nom'] == 'tmoney' || $transaction->transaction_type['nom'] == 'flooz') {
                $compte = Compte::where('type_compte', $transaction->transaction_type['nom'])->get()[0];
                if ($transaction->transaction_operation_type['nom'] == 'depot') {
                    $compte['solde'] += $transaction['montant'];
                }
                if ($transaction->transaction_operation_type['nom'] == 'retrait') {
                    $compte['solde'] -= $transaction['montant'];
                }
                $compte->save();
            }

            $transaction['deleted'] = true;
            $transaction['motif'] = $request->input('motif');
            $transaction->save();
            $user = auth()->user();
            $log = Log::create([
                'user_id' => $user['id'],
                'type_activite' => 'SUPPRESSION TRANSACTION',
                'transaction_id' => $transaction['id'],
            ]);
            return redirect('more_transaction/' . $transaction['id']);
        }
        return view('delete_transaction', ['transaction' => $transaction]);
    }


    public function register(Request $request)
    {
        $admin = User::where('type_admin', 0)->get();
        if ($admin->count() != 0) {
            return back();
        }
        if ($request->isMethod('post')) {

            if (Str::length($request->input('password')) < 8) {
                return redirect('register')->with('message', 'Le mot de pass est trop court!Veuillez saisir un mot de pass de plus de 8 caracteres');
            }
            if (Str::length($request->input('nom')) < 3) {
                return redirect('register')->with('message', 'Veuillez saisir un nom  de plus de 3 caracteres');
            }
            if (Str::length($request->input('prenom')) < 3) {
                return redirect('register')->with('message', 'Veuillez saisir un prenom  de plus de 3 caracteres');
            }

            if ($request->input('password') != $request->input('password2')) {
                return redirect('register')->with('message', 'Les mots de pass ne correspondent pas!');
                ;
            }

            $user = User::where('email', $request->input('email'))->get();
            if ($user->count() > 0) {
                return redirect('register')->with('message', "L'address email est deja utilise!");
                ;
            }

            $user = User::create([
                'nom' => $request->input('nom'),
                'prenom' => $request->input('prenom'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'type_admin' => 0
            ]);
            $log = Log::create([
                'user_id' => $user['id'],
                'type_activite' => 'CREATION ADMIN SUPREME',
            ]);
            return redirect('/login');
        }
        return view('register');
    }

    public function gestion_compte()
    {
        $flooz = Compte::where('type_compte', 'flooz')->get()[0];
        $tmoney = Compte::where('type_compte', 'tmoney')->get()[0];
        return view('gestion_compte', ['flooz' => $flooz, 'tmoney' => $tmoney]);
    }
    public function approvisionner_compte(Request $request)
    {
        $compte = Compte::where('type_compte', $request->input('type_compte'))->get()[0];
        if ($request->input('type_compte') == null || $request->input('type_compte') == '') {
            return back();
        }
        if ($request->isMethod('post')) {

            $user = auth()->user();
            $approvisionnement = Approvisionnement::create([
                'user_id' => $user['id'],
                'compte_id' => $compte['id'],
                'montant' => $request->input('montant'),
            ]);
            if ($compte['type_compte'] == 'tmoney') {
                $log = Log::create([
                    'user_id' => $user['id'],
                    'type_activite' => 'RECHARGEMENT COMPTE TMONEY',
                ]);
            }
            if ($compte['type_compte'] == 'flooz') {
                $log = Log::create([
                    'user_id' => $user['id'],
                    'type_activite' => 'RECHARGEMENT COMPTE FLOOZ',
                ]);
            }

            $compte['solde'] += $request->input('montant');
            $compte->save();
            return redirect('gestion_compte'); //view('approvisionner',['compte' => $compte] );
        }


        $request->session()->flash('route_name', 'Recharger compte');
        return view('approvisionner', ['compte' => $compte]);
    }

    public function change_password(Request $request){
        $request->session()->remove('error');
        $id = $request->session()->get('id');
        if($id == null){
            return back();
        }
        $user = User::find($id);
        if($user == null){
            return back();
        }
        if($request->isMethod('post')){
            if ($request->input('password') < 8) {
                $request->session()->flash('error','Choisissez un mot de pass de 8 caracteres minimum!');
                return view('change_password');
            }
            if ($request->input('password') != $request->input('password2')) {
                $request->session()->flash('error','Les mots de pass ne correspondent pas!');
                return view('change_password');
            }
            $user['password'] = $request->input('password');
            $user['first_time'] = false;
            $user->save();
            $log = Log::create([
                'user_id' => $user['id'],
                'type_activite' => 'CHANGEMENT MOT DE PASS',
            ]);

            if (
                auth()->attempt([
                    'email' => $user['email'],
                    'password' => $request->input('password'),
                ])
            ) {

                $request->session()->regenerate();
                //$user = auth()->user();
                $log = Log::create([
                    'user_id' => $user['id'],
                    'type_activite' => 'CONNEXION',
                ]);
                $request->session()->remove('error');
                $request->session()->remove('id');
                return redirect('/dashboard');
            }


            
        }
        return view('change_password');
    }
}


// password: $2y$10$v6iSWEhiVor6UqZsMWQFyuS4x9OqIOP5xpx.QDVvcICNVxRCFc97G