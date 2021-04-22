<div class="row mt-3 mb-3 text-white text-uppercase py-2">
    <div class="col-12 bg-danger py-2 text-center text-uppercase">Billing Account</div>
</div>

<div class="row">
    @if (count($assessments) > 0)
        @foreach ($assessments as $assessment)
            <div class="col-md-6 col-12 col-12 my-3">
                <div class="card card-shadow">
                    <div class="card-body">
                        <div class="row d-flex flex-row-reverse flex-md-row border-bottom mb-3">
                            @php
                                $semester = '';
                                if($assessment->sem == 1){
                                    $semester = '1st Semester';
                                }elseif($assessment->sem == 2){
                                    $semester = '2nd Semester';
                                }else{
                                    $semester = 'Summer';
                                }
                            @endphp
                            <div class="col-md-8 col-12 pb-3 font-weight-bold">AY: {{ $assessment->ay }} | {{ $semester }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-7">Tuition Fee</div>
                            <div class="col-5 text-right">₱ {{ number_format($assessment->tuition_fee,2) }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-7">Miscellaneous Fee</div>
                            <div class="col-5 text-right">₱ {{ number_format($assessment->misc_fee,2) }}</div>
                        </div>
                        <hr class="m-0">
                        <div class="row mb-2">
                            <div class="col-md-4 col-7">TOTAL</div>
                            <div class="offset-md-4 col-md-4 col-5 text-right">₱ {{ number_format($assessment->total,2) }}</div>
                        </div>
                        <p class="text-danger m-0"><i>Less:</i></p>
                        @php
                            $totalDeductions = 0;
                        @endphp
                        @foreach ($assessment->deductions as $deduction)
                            <div class="row">   
                                <div class="col-md-4 col-7">{{$deduction->deduction_name}}</div>
                                <div class="col-5 text-right">₱ {{ number_format($deduction->amount,2) }}</div>
                            </div>
                            @php
                                (float)$totalDeductions += $deduction->amount;
                            @endphp
                        @endforeach
                        
                        <hr class="m-0">
                        
                        <div class="row">
                            <div class="col-md-6 col-7 text-uppercase">Deductions</div>
                            <div class="col-md-6 col-5 text-right">₱ {{ number_format($totalDeductions,2) }}</div>
                        </div>
                        <div class="row font-weight-bold">
                            @php
                                $badgeColor = '';
                                $balanceType = '';
                                if($assessment->balance_type == 0){
                                    $badgeColor = 'badge-success';
                                    $balanceType = 'Fully Paid';
                                }elseif($assessment->balance_type == 1){
                                    $badgeColor = 'badge-danger';
                                    $balanceType = 'Collectible';
                                }else{
                                    $badgeColor = 'badge-success';
                                    $balanceType = 'Refundable';
                                }
                            @endphp
                            <div class="col-md-6 col-7 text-uppercase">
                                Total Balance<br>
                                <span class="badge px-3 py-1 {{ $badgeColor }}">{{ $balanceType }}</span>
                            </div>
                            @php
                                $totalBalance = $assessment->total - $totalDeductions;
                                $floatBalance = (float)$totalBalance
                            @endphp
                            <div class="col-md-6 col-5 text-right">₱ {{ number_format($floatBalance) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="col-12">
            <div class="alert alert-danger">
                <strong>Sorry,</strong> there are no billing records to show at the moment.
            </div>
        </div>
    @endif
</div>

<p class="text-uppercase bg-success py-2 pl-md-3 pl-1 text-white">General Computation</p>
<div class="row border mx-0 bg-white py-3">
    <div class="col-md-6 col-12">
        @php
            $grandBalance = 0;
            $grandDeduction = 0;
            $semester = '';
        @endphp
        @foreach ($assessments as $assessment)
            @php
                $semDeductions = 0;
                foreach($assessment->deductions as $deduction){
                    $semDeductions += $deduction->amount;
                }
                (float)$semBalance = $assessment->total - $semDeductions;
                if($assessment->sem == 1){
                    
                }

                if($assessment->sem == 1){
                    $semester = '1st Semester';
                }elseif($assessment->sem == 2){
                    $semester = '2nd Semester';
                }else($assessment->sem == 3){
                    $semester = 'Summer'
                }
            @endphp
            <div class="row pl-md-3">
                <div class="col-md-6 col-8">AY: {{ $assessment->ay }} | {{ $semester }}</div>
                <div class="col-md-6 col-4 text-right">₱ {{ number_format($semBalance,2) }}</div>
            </div>
            @php
                (float)$grandBalance += $assessment->total;
                (float)$grandDeduction += $semDeductions;
            @endphp
        @endforeach
    </div>
    <div class="col-md-6 col-12 text-right">
        @php
            (float)$totalBalance = $grandBalance - $grandDeduction;
            $badgeColor = '';
            $balanceType = '';
            if($totalBalance == 0){
                $badgeColor = 'badge-success';
                $balanceType = 'Fully Paid';
            }elseif($totalBalance > 0){
                $badgeColor = 'badge-danger';
                $balanceType = 'Collectible';
            }elseif($totalBalance < 0){
                $badgeColor = 'badge-success';
                $balanceType = 'Refundable';
            }
        @endphp
        <p class="font-30 mb-0 font-weight-bold">
            ₱ {{ number_format($totalBalance,2) }}<br>            
        </p>
        <span class="badge px-3 text-uppercase font-20 {{ $badgeColor }}">{{ $balanceType }}</span>
    </div>
</div>