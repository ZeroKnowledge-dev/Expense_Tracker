<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReportController extends Controller {
	public function ReportPage() {
		return Inertia::render('Report/ReportPage');
	}

	public function salesReport(Request $request) {
		$user_id  = auth()->user()->id;
		$FromDate = date('Y-m-d', strtotime($request->FromDate));
		$ToDate   = date('Y-m-d', strtotime($request->ToDate));

		$totalDeposits    = Item::where('user_id', $user_id)->whereDate('created_at', '>=', $FromDate)->whereDate('created_at', '<=', $ToDate)->where('type', 'Deposit')->sum('amount');
		$totalWithdrawals = Item::where('user_id', $user_id)->whereDate('created_at', '>=', $FromDate)->whereDate('created_at', '<=', $ToDate)->where('type', 'Withdrawal')->sum('amount');
		$balanceLeft      = $totalDeposits - $totalWithdrawals;

		$list = Item::where('user_id', $user_id)
			->whereDate('created_at', '>=', $FromDate)
			->whereDate('created_at', '<=', $ToDate)
			->get();

		$data = [
			'totalDeposits'    => $totalDeposits,
			'totalWithdrawals' => $totalWithdrawals,
			'balanceLeft'      => $balanceLeft,
			'list'             => $list,
			'FromDate'         => $request->FromDate,
			'ToDate'           => $request->ToDate,
		];

		$pdf = PDF::loadView('SalesReport', $data);
		return $pdf->download('SalesReport.pdf');
	}
}
