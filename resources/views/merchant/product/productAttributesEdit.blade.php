
@push('css')
    <style>
        .attributes-area{
            margin-top: 8px;
        }
        .line-40{
            line-height: 40px;
            margin: 10px 0 !important;
        }
    </style>
@endpush
<div class="card mb-4">
    <h5 class="card-header">Product Attributes<span class="text-danger">*</span></h5>
    <div class="attributes-area col-md-12"> 
        @php $i = 2; @endphp
        @foreach ($product->item_meta as $metas)
            @if($i == 8)
                <div class='less'>
            @endif
            @if($i%2 == 0)
                <div class='from-group row line-40'>
            @endif

            <label for="" class="col-sm-3 text-right">{{$metas->attributes->label}}</label>
            @switch($metas->attributes->type)
                @case('select')
                    <select name="attribute[{{$metas->attributes->id}}]" class="col-sm-3 form-control" id="">
                        @foreach ($metas->attributes->attributeMeta as $row)
                            <option value="Other" {{$row->values == $metas->attr_value ? 'selected' : ''}}>{{$row->values}}</option>
                        @endforeach
                    </select>
                    @break
                @default
                    <input name='attribute[{{$metas->attributes->id}}]' type='text' value="{{$metas->attr_value}}" class='col-sm-3 form-control'>
            @endswitch
            @if($i%2 == 1)
                </div>
            @endif
            @php $i++; @endphp
        @endforeach 
                </div>
    </div>
    <div class="text-center mt-3">
        <a class="collapsed btn btn-sm btn-secondery col-md-10 button1"><i class="fa fa-angle-double-down"></i> More</a>
        <a class="expanded btn btn-sm btn-secondery col-md-10 button1"><i class="fa fa-angle-double-up"></i> Less</a>
    </div>
</div>

@push('js')
    <script>
        function getCategoryAttr(cat_id = 2){
            $.ajax({
                type:"Post",
                dataType: "json",
                url:"{{ url('merchant/get-category-attr/')  }}",
                data:{ 'cat_id': cat_id, '_token' : '{{ csrf_token() }}'},
                success:function(data){
                    $('.attributes-area').html(data.attributes);
                    $('.less').hide();
                    $('.more').show();
                    $('.expanded').hide();
                }
            })
        }

        $(document).ready(function(){
            $('.less').hide();
            $('.more').show();
            $('.expanded').hide();
        });

        $('.collapsed').on('click',function(){
            $('.less').show();
            $('.more').hide();
            $('.expanded').show();
            $('.collapsed').hide();
        });
        $('.expanded').on('click',function(){
            $('.less').hide();
            $('.more').show();
            $('.expanded').hide();
            $('.collapsed').show();
        });
    </script>
@endpush
