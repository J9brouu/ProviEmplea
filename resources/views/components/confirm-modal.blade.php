<div x-data="{
    open: false,
    title: '',
    message: '',
    formId: '',
    show(title, message, formId) {
        this.title   = title;
        this.message = message;
        this.formId  = formId;
        this.open    = true;
    },
    confirm() {
        document.getElementById(this.formId).submit();
        this.open = false;
    }
}"
    x-on:confirm-delete.window="show($event.detail.title, $event.detail.message, $event.detail.formId)"
    x-show="open"
    x-transition.opacity
    class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/60 backdrop-blur-sm p-4"
    style="display:none;">

    <div @click.away="open = false" x-transition
        class="bg-white w-full max-w-md rounded-3xl shadow-2xl overflow-hidden">

        <!-- HEADER -->
        <div class="bg-gradient-to-r from-red-500 to-rose-600 px-8 py-6 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-white" x-text="title"></h2>
                <p class="text-red-100 text-sm mt-1">Esta acción no se puede deshacer</p>
            </div>
            <button @click="open = false" class="text-white text-3xl hover:rotate-90 transition leading-none">&times;</button>
        </div>

        <!-- BODY -->
        <div class="p-8">
            <p class="text-gray-600 text-center" x-text="message"></p>

            <div class="flex gap-4 mt-8">
                <button @click="open = false"
                    class="flex-1 px-6 py-3 rounded-2xl border border-gray-300 hover:bg-gray-100 text-gray-700 font-medium transition">
                    Cancelar
                </button>
                <button @click="confirm()"
                    class="flex-1 px-6 py-3 rounded-2xl bg-red-500 hover:bg-red-600 text-white font-semibold transition shadow">
                    Sí, eliminar
                </button>
            </div>
        </div>
    </div>
</div>
