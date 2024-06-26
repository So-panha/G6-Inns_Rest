<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-8">
                <h3 class="text-gray-700 text-3xl font-medium">Welcome : {{ auth()->user()->name }}</h3>
                <div class="bg-white shadow-md rounded my-6 p-5">
                    <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="flex justify-evenly gray-500 mt-5">
                            <div class="w-1/3">
                                <div class="bg-white rounded-lg">
                                    <div class="main_profile" x-data="imageData()">
                                        <div x-show="previewUrl == '' && imgurl == ''">
                                            <p class="text-center uppercase text-bold">
                                                <label for="thumbnailprev"
                                                    class="cursor-pointer bg-red-400 p-2 mb-5 rounded-lg">
                                                    Upload a file
                                                </label>
                                                <input type="file" name="profile" id="thumbnailprev"
                                                    class="hidden thumbnailprev" @change="updatePreview()">
                                            </p>
                                        </div>

                                        <div x-show="previewUrl !== ''" class="relative h-48 w-48">
                                            <img :src="previewUrl" alt=""
                                                class="border-profile shadow-lg rounded-full max-w-full h-auto align-middle border-none h-full w-full object-cover">
                                            <div class="btn-change">
                                                <button type="button" class="" @click="clearPreview()"><span
                                                        class="material-symbols-outlined">
                                                        edit_square
                                                    </span></button>
                                            </div>
                                        </div>

                                        <div x-show="imgurl !== ''" class="relative h-48 w-48">
                                            <img :src="imgurl" alt=""
                                                class="border-profile shadow-lg rounded-full max-w-full h-auto align-middle border-none h-full w-full object-cover">
                                            <div class="btn-change">
                                                <button type="button" class="" @click="clearPreview()"><span
                                                        class="material-symbols-outlined">
                                                        edit_square
                                                    </span></button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="text-center">
                                    <h1 class="h1_title">User name</h1>
                                    <h3>{{ auth()->user()->name }}</h3>
                                </div>
                            </div>
                            <div class="w-4/5 mr-12">
                                <div class="flex flex-col">
                                    <h1 class="h1_title">Account Details</h1>
                                </div>
                                <div class="flex flex-col space-y-2">
                                    <label for="name" class="text-gray-700 select-none font-medium">User
                                        Name</label>
                                    <input id="name" type="text" name="name"
                                        value="{{ old('name', $user->name) }}" placeholder="Enter name"
                                        class="bg-input px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                                </div>

                                <div class="flex flex-col space-y-2 mt-3">
                                    <label for="email" class="text-gray-700 select-none font-medium">Email</label>
                                    <input id="email" type="text" name="email"
                                        value="{{ old('email', $user->email) }}" placeholder="Enter email"
                                        class="bg-input px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                                </div>

                                <div class="flex flex-col space-y-2 mt-3">
                                    <label for="email" class="text-gray-700 select-none font-medium">Phone</label>
                                    <input id="email" type="text" name="email"
                                        value="{{ old('email', $user->email) }}" placeholder="Enter email"
                                        class="bg-input px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                                </div>

                                <div class="flex justify-end mt-16 mb-16">
                                    <button type="submit"
                                        class="bg-green-600 text-white font-bold px-5 py-2 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors duration-300">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
    </div>


    <script>
        function imageData() {
            var files = document.getElementById("thumbnailprev").files;
            if (files.length == 0) {
                var url = '/images/' + {!! json_encode($user->profile) !!};
            } else {
                url = '';
            }
            return {
                previewUrl: "",
                imgurl: url,
                updatePreview() {
                    var reader, files = document.getElementById("thumbnailprev").files;
                    reader = new FileReader();
                    reader.onload = e => {
                        this.previewUrl = e.target.result;
                    };
                    reader.readAsDataURL(files[0]);
                },
                clearPreview() {
                    document.getElementById("thumbnailprev").value = null;
                    this.previewUrl = "";
                    this.imgurl = "";
                }
            };
        }
    </script>
    <style scoped>
        .btn-change {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 25%;
            height: 25%;
            border-radius: 50%;
            text-align: center;
            line-height: 60px;
        }

        .material-symbols-outlined {
            font-size: 250%;
            color: #000000;
        }

        .border-profile {
            border: solid 3px #000000;
        }

        .main_profile {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .h1_title {
            font-size: 30px;
            font-weight: 600;
        }

        .bg-input {
            background-color: darkgray;
        }
    </style>
</x-app-layout>
