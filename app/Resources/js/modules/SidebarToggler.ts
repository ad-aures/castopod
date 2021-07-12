const SidebarToggler = (): void => {
  const sidebar = document.querySelector(
    "aside[id='admin-sidebar']"
  ) as HTMLElement;
  const toggler = document.querySelector(
    "button[id='sidebar-toggler']"
  ) as HTMLButtonElement;
  const sidebarBackdrop = document.querySelector(
    "div[id='sidebar-backdrop']"
  ) as HTMLElement;

  const setAriaExpanded = (isExpanded: "true" | "false") => {
    toggler.setAttribute("aria-expanded", isExpanded);
    sidebarBackdrop.setAttribute("aria-expanded", isExpanded);
  };

  const hideSidebar = () => {
    setAriaExpanded("false");
    sidebar.classList.add("-translate-x-full");
    sidebarBackdrop.classList.add("hidden");
    toggler.style.transform = "translateX(0px)";
  };

  const showSidebar = () => {
    setAriaExpanded("true");
    sidebar.classList.remove("-translate-x-full");
    sidebarBackdrop.classList.remove("hidden");
    toggler.style.transform =
      "translateX(" + sidebar.getBoundingClientRect().width + "px)";
  };

  toggler.addEventListener("click", () => {
    if (sidebar.classList.contains("-translate-x-full")) {
      showSidebar();
    } else {
      hideSidebar();
    }
  });

  sidebarBackdrop.addEventListener("click", () => {
    if (!sidebar.classList.contains("-translate-x-full")) {
      hideSidebar();
    }
  });

  const setAriaExpandedOnWindowEvent = () => {
    const isExpanded =
      !sidebar.classList.contains("-translate-x-full") ||
      window.innerWidth >= 768;
    const ariaExpanded = toggler.getAttribute("aria-expanded");
    if (isExpanded && (!ariaExpanded || ariaExpanded === "false")) {
      setAriaExpanded("true");
    } else if (!isExpanded && (!ariaExpanded || ariaExpanded === "true")) {
      setAriaExpanded("false");
    }
  };

  window.addEventListener("load", setAriaExpandedOnWindowEvent);
  window.addEventListener("resize", setAriaExpandedOnWindowEvent);
};

export default SidebarToggler;
