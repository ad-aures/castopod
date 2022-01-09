const ValidateFileSize = (): void => {
  const fileInputContainers: NodeListOf<HTMLInputElement> =
    document.querySelectorAll("[data-max-size]");

  for (let i = 0; i < fileInputContainers.length; i++) {
    const fileInput = fileInputContainers[i] as HTMLInputElement;

    fileInput.addEventListener("change", () => {
      if (fileInput.files) {
        const fileSize = fileInput.files[0].size;

        if (fileSize > parseFloat(fileInput.dataset.maxSize ?? "0")) {
          alert(fileInput.dataset.maxSizeError);
          // remove the selected file by resetting input to prevent from uploading it.
          fileInput.value = "";
        }
      }
    });
  }
};

export default ValidateFileSize;
