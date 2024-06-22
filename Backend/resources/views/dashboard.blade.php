<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <!-- <div class="container mx-auto px-6 py-8"> -->
            <!-- 
                
                <h3 class="text-gray-700 text-3xl font-medium">Welcome : {{ auth()->user()->name }}</h3>                

                <p>Role : <b>
                    @foreach(auth()->user()->roles as $role)
                        {{ $role->name }}
                    @endforeach 
                </b> </p> -->

            <!-- </div> -->
            <div class="row">
                <!-- <div class="col-xl-3 col-md-6">
                    <div class="card bg-blue-900 text-white mb-4">
                        <div class="card-body">
                            total
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View</a>
                            <div class="small text-white"><i class=""></i></div>
                        </div>
                    </div>
                </div> -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-4">
                    <!-- Card 1 -->
                    <div class="bg-white rounded-lg border border-gray-200 shadow-md">
                        <div class="p-5">
                            <span class="text-gray-700 text-base mb-4">
                                 $6.200 (+12.80%)
</span>
                            <p class="text-gray-700 text-base mb-4">
                                Total
                            </p>

                        </div>
                    </div>
                    <!-- Card 1 -->
                    <div class="bg-white rounded-lg border border-gray-200 shadow-md">
                        <div class="p-5">
                            <span class="text-gray-700 text-base mb-4">
                                26K (+15.5%)
                            </span>
                            <p class="text-gray-700 text-base mb-4">
                                Users
                            </p>
                            <div class="custom-shape-divider-top">
                            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                                <path d="M0,0V7.23C0,65.52,268.63,112.77,600,112.77S1200,65.52,1200,7.23V0Z" class="shape-fill"></path>
                            </svg>
                            </div>

                        </div>
                    </div>
                    <!-- Card 1 -->
                    <div class="bg-white rounded-lg border border-gray-200 shadow-md">
                        <div class="p-5">
                            <span class="text-gray-700 text-base mb-4">
                                44K (+15.5%)
                            </span>
                            <p class="text-gray-700 text-base mb-4">
                            Owner
                            </p>

                        </div>
                    </div>
                   
                    
                </div>
            </div>
        </main>
    </div>
    </div>
</x-app-layout>
<style>
     .custom-shape-divider-top {
        position: relative;
            overflow: hidden;
            width: 100%;
            height: 20px; /* Smaller height for a subtle curve */
            line-height: 0;
        }
        .custom-shape-divider-top svg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .custom-shape-divider-top .shape-fill {
            fill: #000000;
        }

</style>