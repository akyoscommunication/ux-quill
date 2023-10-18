'use strinct';

import { Controller } from '@hotwired/stimulus';
import Quill from 'quill';

let isQuillInitialized = false;

export default class extends Controller {
    private quill: Quill | null = null;

    connect() {
        if (!isQuillInitialized) {
            isQuillInitialized = true;
            this.dispatchEvent('init', {
                Quill
            })
        }

        this.quill = new Quill(this.element);

        this.dispatchEvent('connect', { quill: this.quill });
    }

    private dispatchEvent(name: string, payload: any) {
        this.dispatch(name, { detail: payload, prefix: 'quill' });
    }
}
