import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

document.addEventListener('alpine:init', () => {
    Alpine.store('theme', {
        dark: document.documentElement.classList.contains('dark'),
        toggle() {
            this.dark = !this.dark;
            document.documentElement.classList.toggle('dark', this.dark);
            try {
                localStorage.setItem('theme', this.dark ? 'dark' : 'light');
            } catch (e) {}
        },
    });

    // Terjemahan bahasa via Google Translate (custom, cookie `googtrans`)
    Alpine.store('lang', {
        current: 'id',
        init() {
            const m = document.cookie.match(/(?:^|;\s*)googtrans=\/[^/]+\/([^;]+)/);
            this.current = m && m[1] === 'en' ? 'en' : 'id';
        },
        set(lang) {
            if (lang !== 'id' && lang !== 'en') return;
            if (lang === this.current) return;
            const value = '/id/' + lang;
            const host = location.hostname;
            const cookies = [
                'googtrans=' + value + ';path=/',
                'googtrans=' + value + ';path=/;domain=' + host,
                'googtrans=' + value + ';path=/;domain=.' + host,
            ];
            cookies.forEach((c) => { document.cookie = c; });
            this.current = lang;
            location.reload();
        },
    });

    Alpine.data('coverUploader', (existing = null) => ({
        preview: existing,
        dragging: false,
        setFiles(files) {
            const file = files && files[0];
            if (!file || !file.type.startsWith('image/')) {
                return;
            }
            const reader = new FileReader();
            reader.onload = (e) => { this.preview = e.target.result; };
            reader.readAsDataURL(file);
            const input = this.$refs.input;
            if (input && files !== input.files) {
                const dt = new DataTransfer();
                dt.items.add(file);
                input.files = dt.files;
            }
            if (this.$refs.remove) {
                this.$refs.remove.checked = false;
            }
        },
        clear() {
            this.preview = null;
            if (this.$refs.input) {
                this.$refs.input.value = '';
            }
        },
    }));

    Alpine.store('confirm', {
        open: false,
        title: 'Konfirmasi',
        message: '',
        confirmText: 'Hapus',
        form: null,
        ask(form, opts = {}) {
            this.form = form;
            this.title = opts.title || 'Konfirmasi';
            this.message = opts.message || 'Apakah Anda yakin?';
            this.confirmText = opts.confirmText || 'Hapus';
            this.open = true;
        },
        cancel() {
            this.open = false;
            this.form = null;
        },
        proceed() {
            const form = this.form;
            this.open = false;
            this.form = null;
            if (form) {
                form.submit();
            }
        },
    });
});

Alpine.start();
