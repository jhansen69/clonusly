class Dropzone {
    constructor(dropzoneId, uploadPath) {
        this.dropzone = document.getElementById(dropzoneId);
        this.uploadPath = uploadPath;

        if (!this.dropzone) {
            throw new Error(`Element with ID ${dropzoneId} not found.`);
        }

        this.initializeDropzone();
    }

    initializeDropzone() {
        // Create and insert message paragraph
        this.dropzoneMsg = document.createElement('p');
        this.dropzoneMsg.textContent = "Click or drop file(s) to upload";
        this.dropzone.appendChild(this.dropzoneMsg);

        // Create and insert input element
        this.dropInput = document.createElement('input');
        this.dropInput.type = 'file';
        this.dropInput.multiple = true;
        this.dropInput.style.display = 'none';
        this.dropzone.appendChild(this.dropInput);

        // Add event listeners
        this.addEventListeners();
    }

    addEventListeners() {
        this.dropzone.addEventListener('click', () => {
            this.dropInput.click();
            this.dropInput.onchange = (e) => {
                this.upload(e.target.files);
            }
        });

        this.dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
        });

        this.dropzone.addEventListener('drop', async (e) => {
            e.preventDefault();

            if (![...e.dataTransfer.items].every(item => item.kind === 'file')) {
                this.dropzoneMsg.textContent = "Error: Not a file or files";
                throw new Error("Not a file or files");
            }

            const filesArray = [...e.dataTransfer.files];

            const areFiles = await Promise.all([...e.dataTransfer.files].map((file) => {
                return new Promise((resolve) => {
                    const fr = new FileReader();
                    fr.onprogress = (e) => {
                        if (e.loaded > 50) {
                            fr.abort();
                            resolve(true);
                        }
                    };
                    fr.onload = () => { resolve(true); };
                    fr.onerror = () => { resolve(false); };
                    fr.readAsArrayBuffer(file);
                });
            }));

            if (!areFiles.every(item => item === true)) {
                this.dropzoneMsg.textContent = "Error: Not a file or files (cannot be a folder)";
                throw new Error("Couldn't read file(s)");
            }

            this.upload(filesArray);
        });
    }

    upload(files) {
        const fd = new FormData();

        for (let i = 0; i < files.length; i++) {
            fd.append(`file${i + 1}`, files[i]);
        }

        const req = new XMLHttpRequest();
        req.open('POST', this.uploadPath);

        this.dropzoneMsg.textContent = "Uploading...";

        req.upload.addEventListener('progress', (e) => {
            const progress = e.loaded / e.total;
            this.dropzoneMsg.textContent = (progress * 100).toFixed() + "%";

            if (progress === 1) {
                this.dropzoneMsg.textContent = "Processing...";
            }
        });

        req.addEventListener('load', () => {
            if (req.status === 200) {
                this.dropzoneMsg.textContent = "Success!";
                console.log(JSON.parse(req.responseText));
            } else {
                this.dropzoneMsg.textContent = "Upload Failed";
                console.log("Bad Response");
            }
        });

        req.addEventListener('error', () => {
            this.dropzoneMsg.textContent = "Upload Failed";
            console.log("Network error");
        });

        req.send(fd);
    }
}