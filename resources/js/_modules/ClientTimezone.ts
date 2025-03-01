const ClientTimezone = (): void => {
  const input: HTMLInputElement | null = document.querySelector(
    "input[name='client_timezone']"
  );

  if (input) {
    input.value = Intl.DateTimeFormat().resolvedOptions().timeZone;
  }
};

export default ClientTimezone;
