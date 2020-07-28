import { createPopper, Placement } from "@popperjs/core";

const Dropdown = (): void => {
  const dropdownContainers: NodeListOf<HTMLElement> = document.querySelectorAll(
    "[data-toggle='dropdown']"
  );

  for (let i = 0; i < dropdownContainers.length; i++) {
    const dropdownContainer = dropdownContainers[i];

    const button: HTMLElement | null = dropdownContainer.querySelector(
      "[data-popper='button']"
    );
    const menu: HTMLElement | null = dropdownContainer.querySelector(
      "[data-popper='menu']"
    );

    if (button && menu) {
      const popper = createPopper(button, menu, {
        placement: menu.dataset.popperPlacement as Placement,
        modifiers: [
          {
            name: "offset",
            options: {
              offset: [menu.dataset.popperOffsetX, menu.dataset.popperOffsetY],
            },
          },
        ],
      });

      const dropdownToggle = () => {
        const isExpanded = !menu.classList.contains("hidden");

        if (isExpanded) {
          menu.classList.add("hidden");
          menu.classList.remove("flex");
        } else {
          menu.classList.add("flex");
          menu.classList.remove("hidden");
        }

        button.setAttribute("aria-expanded", isExpanded.toString());
        popper.update();
      };

      // Toggle dropdown menu on button click event
      button.addEventListener("click", dropdownToggle);

      // Toggle off when clicking outside of dropdown
      document.addEventListener("click", function (event) {
        const isExpanded = !menu.classList.contains("hidden");
        const isClickOutside = !dropdownContainer.contains(
          event.target as Node
        );

        if (isExpanded && isClickOutside) {
          dropdownToggle();
        }
      });
    }
  }
};

export default Dropdown;
