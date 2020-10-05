    
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
            </div>
            <div class="text-center mt-3">
                <a class="decrease btn btn-sm btn-secondery col-md-10 button1"><i class="fa fa-angle-double-down"></i> More</a>
                <a class="increase btn btn-sm btn-secondery col-md-10 button1"><i class="fa fa-angle-double-up"></i> Less</a>
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
                    $('.increase').hide(); 
                }
            })
        }

    $(document).ready(function(){
        $('.less').hide();
        $('.more').show();
        $('.increase').hide(); 
    });

    $('.decrease').on('click',function(){
            $('.less').show();
            $('.more').hide();
            $('.increase').show(); 
            $('.decrease').hide(); 
        });
    $('.increase').on('click',function(){
        $('.less').hide();
        $('.more').show();
        $('.increase').hide(); 
        $('.decrease').show(); 
    });    
   </script>
  @endpush