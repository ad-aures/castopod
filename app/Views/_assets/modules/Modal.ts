const Modal = (): void => {
  const modalTriggerElements: NodeListOf<HTMLElement> = document.querySelectorAll(
    "[data-modal-target]"
  );

  for (let i = 0; i < modalTriggerElements.length; i++) {
    const modalTrigger = modalTriggerElements[i];

    if (modalTrigger.dataset.modalTarget) {
      const modal: HTMLElement | null = document.getElementById(
        modalTrigger.dataset.modalTarget
      );

      if (modal) {
        modalTrigger.addEventListener("click", () => {
          modal.classList.toggle("hidden");
        });

        const closeButtonsElements: NodeListOf<HTMLElement> = modal.querySelectorAll(
          "[data-modal-button]"
        );

        for (let j = 0; j < closeButtonsElements.length; j++) {
          const closeButton = closeButtonsElements[j];
          closeButton.addEventListener("click", () => {
            modal.classList.toggle("hidden");
          });
        }
      }
    }
  }
};

export default Modal;
