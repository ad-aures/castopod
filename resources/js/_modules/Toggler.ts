const Toggler = (): void => {
  const togglerElements: NodeListOf<HTMLElement> =
    document.querySelectorAll("[data-toggle]");

  for (let i = 0; i < togglerElements.length; i++) {
    const toggler = togglerElements[i];

    if (toggler.dataset.toggle) {
      const target: HTMLElement | null = document.getElementById(
        toggler.dataset.toggle
      );

      if (target && toggler.dataset.toggleClass) {
        toggler.addEventListener("click", () => {
          toggler.dataset.toggleClass?.split(" ").forEach((className) => {
            target.classList.toggle(className);
          });

          if (toggler.dataset.toggleBodyClass) {
            toggler.dataset.toggleBodyClass.split(" ").forEach((className) => {
              document.body.classList.toggle(className);
            });
          }
        });
      }
    }
  }
};

export default Toggler;
