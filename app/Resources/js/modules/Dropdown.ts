import { createPopper, Instance, Placement } from "@popperjs/core";

const Dropdown = (): void => {
  const dropdownButtons: NodeListOf<HTMLButtonElement> =
    document.querySelectorAll("[data-dropdown='button']");

  for (let i = 0; i < dropdownButtons.length; i++) {
    const button = dropdownButtons[i];

    if (button.dataset.dropdownTarget) {
      const menu: HTMLElement | null = document.getElementById(
        button.dataset?.dropdownTarget
      );

      if (menu) {
        // place the menu at then end of the body to prevent any overflow cuts
        document.body.appendChild(menu);

        let popperInstance: Instance | null = null;

        const create = () => {
          const offsetX = menu.dataset.dropdownOffsetX
            ? parseInt(menu.dataset.dropdownOffsetX)
            : 0;
          const offsetY = menu.dataset.dropdownOffsetY
            ? parseInt(menu.dataset.dropdownOffsetY)
            : 0;
          console.log(offsetX, offsetY);
          popperInstance = createPopper(button, menu, {
            placement: menu.dataset.dropdownPlacement as Placement,
            modifiers: [
              {
                name: "offset",
                options: {
                  offset: [offsetX, offsetY],
                },
              },
            ],
          });
        };

        const destroy = () => {
          if (popperInstance) {
            popperInstance.destroy();
            popperInstance = null;
          }
        };

        const dropdownToggle = () => {
          const isExpanded = menu.hasAttribute("data-show");

          if (isExpanded) {
            menu.removeAttribute("data-show");
            button.setAttribute("aria-expanded", "false");
            destroy();
          } else {
            menu.setAttribute("data-show", "");
            button.setAttribute("aria-expanded", "true");
            create();
          }
        };

        // Toggle dropdown menu on button click event
        button.addEventListener("click", dropdownToggle);

        // Toggle off when clicking outside of dropdown
        document.addEventListener("click", function (event) {
          const isExpanded = menu.hasAttribute("data-show");
          const isClickOutside =
            !menu.contains(event.target as Node) &&
            !button.contains(event.target as Node);

          if (isExpanded && isClickOutside) {
            dropdownToggle();
          }
        });
      }
    }
  }
};

export default Dropdown;
