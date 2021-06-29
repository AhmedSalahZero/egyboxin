<?php $order = 1   ?>
<?php $barcodes_ids ='' ?>
@forelse($barcodes as $key=>$barcode)
    <tr class="text-center form_data_here"
        data-sum_price="{{$totalPriceExceptReturned}}"
        data-end_debrief="{{$endDebrief}}"
        data-barcodes_id="{{$barcodes_ids .= $barcode->id . ','}}"
    >
        <td>
            {{$order++}}
        </td>
        <td>
            {{$barcode->barcode_number}}
        </td>
        <td>
            {{$barcode->status}}
        </td>

        <td>
            {{$barcode->sub_area->name}}
        </td>
        <td>
            {{$barcode->client_name}}
        </td>
        <td>
            {{$barcode->seller->name}}
        </td>

        <td>
          @if($barcode->status =='RTO' || $barcode->status== 'Returned')
              0
            @else
            {{$barcode->price }} EGP
              @endif
        </td>


    </tr>

@empty

    <tr class="no_data_available_row">
        <td colspan="7">
        <h3 class="text-center">
           No Data Available
        </h3>
        </td>
    </tr>

@endforelse

