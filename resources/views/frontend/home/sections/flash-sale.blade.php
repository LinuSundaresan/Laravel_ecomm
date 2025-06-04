<section id="wsus__flash_sell" class="wsus__flash_sell_2">
    <div class=" container">
        <div class="row">
            <div class="col-xl-12">
                <div class="offer_time" style="background: url({{ asset('frontend/images/flash_sell_bg.jpg') }})">
                    <div class="wsus__flash_coundown">
                        <span class=" end_text">Flash Sale</span>
                        <div class="simply-countdown simply-countdown-one"></div>
                        <a class="common_btn" href="{{ route('flash-sale') }}">see more <i class="fas fa-caret-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row flash_sell_slider">
            @foreach ($flashSaleHomeItems as $flashSaleHomeItem)
            <div class="col-xl-3 col-sm-6 col-lg-4">

                    <div class="wsus__product_item">
                        <span class="wsus__new">{{ productType($flashSaleHomeItem->product->product_type) }}</span>
                        @if(checkDiscount($flashSaleHomeItem->product))
                            <span class="wsus__minus">
                                -{{ calculateDiscountPercentage($flashSaleHomeItem->product->price , $flashSaleHomeItem->product->offer_price) }}%
                            </span>
                        @endif
                        <a class="wsus__pro_link" href="{{ route('product-detail' , $flashSaleHomeItem->product->slug) }}">
                            <img src="{{asset($flashSaleHomeItem->product->thumb_image)}}" alt="product" class="img-fluid w-100 img_1" />
                            <img src="
                            @if(isset($flashSaleHomeItem->product->galleryImages[0]->image))
                                {{asset($flashSaleHomeItem->product->galleryImages[0]->image )}}
                            @else
                                {{asset($flashSaleHomeItem->product->thumb_image)}}
                            @endif
                                " alt="product" class="img-fluid w-100 img_2" />
                        </a>
                        <ul class="wsus__single_pro_icon">
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $flashSaleHomeItem->product->id }}"><i
                                        class="far fa-eye"></i></a></li>
                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                            <li><a href="#"><i class="far fa-random"></i></a>
                        </ul>
                        <div class="wsus__product_details">
                            <a class="wsus__category" href="#">{{ $flashSaleHomeItem->product->category->name }} </a>
                            <p class="wsus__pro_rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>(133 review)</span>
                            </p>
                            <a class="wsus__pro_name" href="{{ route('product-detail' , $flashSaleHomeItem->product->slug) }}">{{ $flashSaleHomeItem->product->name }}</a>

                            @if(checkDiscount($flashSaleHomeItem->product))
                                <p class="wsus__price">{{ $settings->currency_icon }} {{ $flashSaleHomeItem->product->offer_price }} <del>{{ $settings->currency_icon }} {{ $flashSaleHomeItem->product->price }}</del></p>
                            @else
                            <p class="wsus__price">{{ $settings->currency_icon }} {{ $flashSaleHomeItem->product->price }} </p>
                            @endif



                            <a class="add_cart" href="#">add to cart</a>
                        </div>
                    </div>


            </div>
            @endforeach

        </div>
    </div>
</section>

<!--==========================
    PRODUCT MODAL VIEW START
===========================-->
@foreach ($flashSaleHomeItems as $flashSaleHomeItem)
<section class="product_popup_modal">
    <div class="modal fade" id="exampleModal-{{ $flashSaleHomeItem->product->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="far fa-times"></i></button>
                    <div class="row">
                        <div class="col-xl-6 col-12 col-sm-10 col-md-8 col-lg-6 m-auto display">
                            <div class="wsus__quick_view_img">
                                @if($flashSaleHomeItem->product->video_link)
                                    <a class="venobox wsus__pro_det_video" data-autoplay="true" data-vbtype="video"
                                    href="{{ $flashSaleHomeItem->product->video_link }}">
                                    <i class="fas fa-play"></i>
                                    </a>
                                @endif
                                <div class="row modal_slider">
                                    <div class="col-xl-12">
                                        <div class="modal_slider_img">
                                            <img src="{{ asset($flashSaleHomeItem->product->thumb_image) }}" alt="product" class="img-fluid w-100">
                                        </div>
                                    </div>

                                    @if(count($flashSaleHomeItem->product->galleryImages)==0)
                                        <div class="col-xl-12">
                                            <div class="modal_slider_img">
                                                <img src="{{ asset($flashSaleHomeItem->product->thumb_image) }}" alt="product" class="img-fluid w-100">
                                            </div>
                                        </div>
                                    @endif

                                    @foreach ($flashSaleHomeItem->product->galleryImages as $image)
                                        <div class="col-xl-12">
                                            <div class="modal_slider_img">
                                                <img src="{{ asset($image->image) }}" alt="{{ $flashSaleHomeItem->product->name }}" class="img-fluid w-100">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="wsus__pro_details_text">
                                <a class="title" href="#">{{ $flashSaleHomeItem->product->name }}</a>
                                <p class="wsus__stock_area"><span class="in_stock">in stock</span> ({{ $flashSaleHomeItem->product->qty }} item)</p>
                                @if(checkDiscount($flashSaleHomeItem->product))
                                    <h4>${{ $flashSaleHomeItem->product->offer_price }} <del>${{ $flashSaleHomeItem->product->price }}</del></h4>
                                @else
                                    <h4>{{ $settings->currency_icon }} {{ $flashSaleHomeItem->product->price }} </h4>
                                @endif


                                <p class="review">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <span>20 review</span>
                                </p>
                                <p class="description">{{ $flashSaleHomeItem->product->short_description }}</p>

                                <div class="wsus_pro_hot_deals">
                                    <h5>offer ending time : </h5>
                                    <div class="simply-countdown simply-countdown-one"></div>
                                </div>

                                <form class="shopping-cart-form form-control">
                                    <div class="wsus__selectbox">
                                        <div class="row">
                                            @foreach ($flashSaleHomeItem->product->variants as $variant)
                                                <div class="col-xl-6 col-sm-6">
                                                    <input type="hidden" name="product_id" value="{{ $flashSaleHomeItem->product->id }}">
                                                    <h5 class="mb-2">select:</h5>
                                                    <select class="select_2" name="state">
                                                        <option value="">-- select--</option>
                                                        @foreach ($variant->productVariantItems as $variantItem)
                                                            <option value="{{ $variantItem->id }}" {{ $variantItem->is_default==1 ? 'selected': '' }}>{{ $variantItem->name }} (${{ $variantItem->price }})</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>

                                    <div class="wsus__quentity">
                                        <h5>quantity :</h5>
                                        <div class="select_number">
                                            <input class="number_area" type="text" min="1" max="100" value="1" />
                                        </div>
                                    </div>

                                    <ul class="wsus__button_area">
                                        <li><button type="submit" class="add_cart" href="#">add to cart</button></li>
                                        <li><a class="buy_now" href="#">buy now</a></li>
                                        <li><a href="#"><i class="fal fa-heart"></i></a></li>
                                        <li><a href="#"><i class="far fa-random"></i></a></li>
                                    </ul>
                                </form>

                                <p class="brand_model"><span>brand :</span> {{ $flashSaleHomeItem->product->brand->name }}</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endforeach
<!--==========================
    PRODUCT MODAL VIEW END
===========================-->

@push('scripts')

<script>

    $(document).ready(function(){

        simplyCountdown('.simply-countdown-one', {
            year: {{ date('Y', strtotime($flashSaleDate->end_date)) }},
            month: {{ date('m', strtotime($flashSaleDate->end_date)) }},
            day: {{ date('d', strtotime($flashSaleDate->end_date)) }},
            enableUtc: true
        });
    });


</script>

@endpush
