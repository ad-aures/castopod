const PublishMessageWarning = (): void => {
  const publishForm: HTMLFormElement | null = document.querySelector(
    "form[data-submit='validate-message']"
  );

  if (publishForm) {
    const messageTextArea: HTMLTextAreaElement | null =
      publishForm.querySelector("[name='message']");
    const submitButton: HTMLButtonElement | null = publishForm.querySelector(
      "button[type='submit']"
    );
    const publishMessageWarning: HTMLDivElement | null =
      publishForm.querySelector("[id='publish-warning']");

    if (
      messageTextArea &&
      submitButton &&
      submitButton.dataset.btnTextWarning &&
      submitButton.dataset.btnText &&
      publishMessageWarning
    ) {
      publishForm.addEventListener("submit", (event) => {
        if (
          messageTextArea.value === "" &&
          publishMessageWarning.classList.contains("hidden")
        ) {
          event.preventDefault();

          publishMessageWarning.classList.remove("hidden");
          messageTextArea.focus();
          submitButton.innerText = submitButton.dataset
            .btnTextWarning as string;
        }
      });

      messageTextArea.addEventListener("input", () => {
        if (
          submitButton.innerText !== submitButton.dataset.btnText &&
          messageTextArea.value !== ""
        ) {
          publishMessageWarning.classList.add("hidden");
          submitButton.innerText = submitButton.dataset.btnText as string;
        }
      });
    }
  }
};

export default PublishMessageWarning;
