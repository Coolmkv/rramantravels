@extends('layouts.webSite')
@section('title', 'Activities')

@section('content')
<style>
h2 {
    font-size: 3rem;
    font-weight: 700;
    background: linear-gradient(45deg, #ff9933, #b22222, #1e3c72, #228b22);
    background-size: 300% 300%;
    background-clip: text;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: gradientShift 4s ease-in-out infinite;
    margin-bottom: 20px;
    position: relative;
}
h2::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 4px;
    background: linear-gradient(90deg, transparent, #ff6b8a, transparent);
    border-radius: 2px;
    animation: underlineGlow 2s ease-in-out infinite alternate;
}
@keyframes gradientShift {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}
@keyframes underlineGlow {
    from { box-shadow: 0 0 5px #ff6b6b; }
    to { box-shadow: 0 0 20px #ff6b6b, 0 0 30px #ff6b6b; }
}
.hovering:hover {
    transform: scale(1.05);
    transition: transform 0.3s ease;
}

/* General Form Styles */
.search-form {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #fff;
   
    box-shadow: 0px 4px 12px rgba(0,0,0,0.2);
    gap: 20px;
    flex-wrap: wrap;
    max-width: 1400px;
    margin: 0 auto;
    padding:10px;
}

.form-heading {
    flex-basis: 100%;
    text-align: left;
    font-size: 1.3rem;
    font-weight: bold;
    color: black;
    margin-bottom: 10px;
}

.form-group {
    display: flex;
    flex-direction: column;
    font-size: 0.9rem;
    color: #555;
    flex: 1;
    min-width: 150px;
    margin-bottom:0px !important;
}

.form-group input,
.form-group textarea {
    border: none;
    outline: none;
    font-size: 1rem;
    font-weight: 600;
    padding: 8px 0;
    background: transparent;
    border-bottom: 1px solid #ddd;
    width: 100%;
}

.search-btn {
    background: #F1C40F;
    color: black;
    border: none;
    border-radius: 30px;
    padding: 14px 30px;
    font-size: 1rem;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
    white-space: nowrap;
    align-self: center;
}

.search-btn:hover {
    background: #43a047;
}

/* Medium Devices (Tablets: 768px - 991px) */
@media (min-width: 768px) and (max-width: 991px) {
    .search-form {
        gap: 15px;
        padding: 12px 15px;
    }

    .form-group {
        flex: 1 1 calc(50% - 7.5px);
    }

    .search-btn {
        flex-basis: 100%;
        margin-top: 10px;
    }
}

/* Small Devices (Mobile: <768px) */
@media (max-width: 767px) {
    .search-form {
        flex-direction: column;
        gap: 12px;
        padding: 12px;
    }

    .form-group {
        flex: 1 1 100%;
    }

    .search-btn {
        width: 100%;
    }
}

</style>

<!-- Activities Section -->
<section class="tour-grid-page py-100 pt-140 rel z-2">
    <div class="blog-banner" >
<img src="./assets/images/odisha.jpeg" style="max-height:200px;width:100%" alt=""> 
              </div>


    <!-- SweetAlert2 for toast -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
    /* General Form Styles */
    .search-form {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #fff;
        padding: 20px;
        box-shadow: 0px 4px 12px rgba(0,0,0,0.2);
        gap: 20px;
        flex-wrap: wrap;
        max-width: 1300px;
        margin: 0 auto;
        border-radius: 15px;
    }

    .form-heading {
        flex-basis: 100%;
        text-align: center;
        font-size: 1.3rem;
        font-weight: bold;
        color: black;
        margin-bottom: 10px;
    }

    /* Form Group with Box & Icon */
    .form-group {
        position: relative;
        flex: 1;
        min-width: 150px;
    }

    .form-group i {
        position: absolute;
        top: 50%;
        left: 15px;
        transform: translateY(-50%);
        color: #888;
        font-size: 1rem;
        pointer-events: none;
        transition: 0.3s;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px 12px 12px 40px; /* left padding for icon */
        border: 1px solid #ddd;
        border-radius: 8px;
        outline: none;
        font-size: 1rem;
        font-weight: 500;
        background: #fafafa;
        transition: 0.3s;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #43a047;
        background: #fff;
    }

    .form-group input:focus + i,
    .form-group textarea:focus + i {
        color: #43a047;
    }

    textarea {
        resize: none;
    }

    .search-btn {
        background: #F1C40F;
        color: black;
        border: none;
        border-radius: 30px;
        padding: 14px 30px;
        font-size: 1rem;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
        white-space: nowrap;
        align-self: center;
    }

    .search-btn:hover {
        background: #43a047;
        color: #fff;
    }

    /* Medium Devices (Tablets: 768px - 991px) */
    @media (min-width: 768px) and (max-width: 991px) {
        .search-form {
            gap: 15px;
            padding: 15px;
        }

        .form-group {
            flex: 1 1 calc(50% - 7.5px);
        }

        .search-btn {
            flex-basis: 100%;
            margin-top: 10px;
        }
    }

    /* Small Devices (Mobile: <768px) */
    @media (max-width: 767px) {
        .search-form {
            flex-direction: column;
            gap: 12px;
            padding: 15px;
        }

        .form-group {
            flex: 1 1 100%;
        }

        .search-btn {
            width: 100%;
        }
    }
</style>

<section style="margin-bottom:50px;">
    <form id="aboutForm" class="search-form">
        @csrf
        <span class="form-heading">Discover Odisha: Where Culture Meets Adventure</span>

        <div class="form-group">
            <input type="text" name="name" placeholder="Your Name" required>
            <i class="fa fa-user"></i>
        </div>

        <div class="form-group">
            <input type="email" name="email" placeholder="Your Email" required>
            <i class="fa fa-envelope"></i>
        </div>

        <div class="form-group">
            <input type="tel" name="phone" placeholder="Your Phone" required>
            <i class="fa fa-phone"></i>
        </div>

        <div class="form-group">
            <textarea name="message" placeholder="Your Message" rows="1" cols="25" required></textarea>
            <i class="fa fa-comment"></i>
        </div>

        <button class="search-btn" type="submit">Submit</button>
    </form>
</section>
<script>
    document.getElementById('aboutForm').addEventListener('submit', function(e) {
        e.preventDefault(); // prevent default form submit

        let form = e.target;
        let formData = new FormData(form);

        fetch("{{ route('query.submit') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Show toast message
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: data.message,
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true
            });

            // Reset form fields
            form.reset();
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!'
            });
        });
    });
    </script>
    <div class="container">
        <div class="row">
            <h2 class="text-center pb-20" style="margin-bottom:100px;"> Popular Activities</h2>

            @if (!empty($activities) && count($activities))
                @foreach ($activities as $item)
                    <div class="col-xl-4 col-md-6 hovering">
                        <div class="destination-item tour-grid style-three bgc-lighter" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <div class="image">
                                @php
                                    $images = is_string($item->activity_image) ? json_decode($item->activity_image, true) : $item->activity_image;
                                    $displayImage = is_array($images) && !empty($images) ? $images[0] : null;
                                @endphp
                                @if ($displayImage)
                                    <img src="{{ asset('storage/' . $displayImage) }}" alt="{{ $item->activity_name }}" class="hotel-image">
                                @else
                                    <img src="{{ asset('path/to/default/image.jpg') }}" alt="Default Image" class="hotel-image">
                                @endif
                            </div>
                            <div class="content">
                                <h5>
                                    <a href="{{ route('activitiesDetailpage', ['slug' => $item->slug]) }}">
                                        {{ $item->activity_name }}
                                    </a>
                                </h5>
                                <div class="destination-footers">
                                    <a href="{{ route('activitiesDetailpage', ['slug' => $item->slug]) }}" class="theme-btn style-two style-three">
                                        <span data-hover="View More">View More</span>
                                        <i class="fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center">No activities available at the moment.</p>
            @endif
        </div>
    </div>
</section>
@endsection
