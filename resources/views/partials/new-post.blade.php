<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" x-cloak x-show="showNewPost">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="flex justify-between w-full px-4 py-4">
                <h1 class="text-lg font-semibold">{{__('New Article')}}</h1>
                <button type="button" class="btn-xs btn-danger-border mr-1" @click="showNewPost = false">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form action="{{ route('proyect.post.store_fast') }}" method="POST" x-data="{
                    formData: {
                        title: '',
                        resume: ''
                    },
                    loading: false,
                    buttonLabel: 'Submit',
                    message: '',
                    errors: '',
                    submit() {
                        this.buttonLabel = 'Submitting...'
                        this.loading = true;
                        this.message = ''
                        fetch('/sistema/articulos/store_fast', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content,
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(this.formData)
                        })
                        .then(response => response.json())
                        .then((data) => {
                            if ( data.ok ) {
                                window.location.href = data.url;
                                this.message = 'Success! Redirect to edit'
                            } else {
                                this.errors = data.errors
                                console.log(data.errors)
                            }
                        })
                        .catch(error => {
                            console.error(error)
                            this.message = 'Error!'
                        })
                        .finally(() => {
                            this.loading = false;
                            this.buttonLabel = 'Submit'
                        })
                    }
                }" @submit.prevent="submit">
                <div class="bg-white px-4 pb-4">
                    <div class="">
                        <div class="block px-4 pb-2">
                            <label class="label">{{__('Article Title')}}</label>
                            <input type="text" class="input-form" placeholder="{{__('Article Title')}}" x-model="formData.title">
                        </div>
                        <div class="block px-4 pb-2">
                            <label class="label">{{__('Description')}}</label>
                            <textarea class="textarea" placeholder="{{__('Description')}}" rows="3" x-model="formData.resume"></textarea>
                        </div>
                    </div>
                    <div class="text-sm font-semibold text-blue-700" x-text="message"></div>
                    <template x-if="errors">
                        <ul class="px-4">
                            <template x-for="(error, index) in errors">
                                <li class="text-sm text-error" x-text="error"></li>
                            </template>
                        </ul>
                    </template>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button type="submit" class="btn-sm btn-submit mr-1" :disabled="loading">{{__('New Article')}}</button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>