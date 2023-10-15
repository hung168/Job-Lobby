@props(['employer'])
<!-- component -->
<div class="container h-screen max-w-full">
    <div class="m-auto my-28 w-96 max-w-lg items-center justify-center overflow-hidden rounded-2xl bg-slate-200 shadow-xl">
        <div class="h-24 bg-white"></div>
        <div class="-mt-20 flex justify-center">
            <img class="h-32 rounded-full" src="https://media.istockphoto.com/vectors/male-profile-flat-blue-simple-icon-with-long-shadow-vector-id522855255?k=20&m=522855255&s=612x612&w=0&h=fLLvwEbgOmSzk1_jQ0MgDATEVcVOh_kqEe0rqi7aM5A=" />
        </div>
        <div class="mt-5 mb-1 px-3 text-center text-lg">{{$employer->company_name}}/div>
        <div class="mb-5 px-3 text-center text-sky-500">{{$employer->company_industry}}</div>
        <blockquote>
        <p class="mx-2 mb-7 text-center text-base">{{$employer->company_size}}</p>
        </blockquote>
    </div>
</div>