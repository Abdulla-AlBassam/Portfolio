<script>
  let menuOpen = false;
  let hoveredCell = -1;

  const sections = [
    { num: "01", name: "Projects", href: "/projects" },
    { num: "02", name: "Photography", href: "/photography" },
    { num: "03", name: "Skills", href: "/skills" },
    { num: "04", name: "Contact", href: "/contact" },
  ];

  function toggleMenu() {
    menuOpen = !menuOpen;
    if (menuOpen) {
      document.body.style.overflow = "hidden";
    } else {
      document.body.style.overflow = "";
      hoveredCell = -1;
    }
  }

  $: colTemplate =
    hoveredCell === -1
      ? "1fr 1fr"
      : hoveredCell === 0 || hoveredCell === 2
        ? "1.8fr 0.7fr"
        : "0.7fr 1.8fr";

  $: rowTemplate =
    hoveredCell === -1
      ? "1fr 1fr"
      : hoveredCell === 0 || hoveredCell === 1
        ? "1.8fr 0.7fr"
        : "0.7fr 1.8fr";
</script>

<!-- Header bar -->
<header class="header">
  <a href="/" class="logo">A.</a>
  <button
    class="hamburger"
    on:click={toggleMenu}
    aria-label="Open menu"
  >
    <span class="hamburger-line"></span>
    <span class="hamburger-line"></span>
    <span class="hamburger-line"></span>
  </button>
</header>

<!-- Menu overlay -->
<div class="menu-overlay" class:open={menuOpen}>
  <div class="menu-top">
    <a href="/" class="logo" on:click={toggleMenu}>A.</a>
    <button
      class="close-btn"
      on:click={toggleMenu}
      aria-label="Close menu"
    >
      <svg
        width="28"
        height="28"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="1.5"
      >
        <line x1="18" y1="6" x2="6" y2="18"></line>
        <line x1="6" y1="6" x2="18" y2="18"></line>
      </svg>
    </button>
  </div>

  <div
    class="menu-grid"
    style="grid-template-columns: {colTemplate}; grid-template-rows: {rowTemplate};"
  >
    {#each sections as section, i}
      <a
        href={section.href}
        class="menu-cell"
        on:mouseenter={() => (hoveredCell = i)}
        on:mouseleave={() => (hoveredCell = -1)}
        on:click={toggleMenu}
      >
        <span class="cell-number">{section.num}</span>
        <span class="cell-name">{section.name}.</span>
      </a>
    {/each}

    <!-- Center hub -->
    <a
      href="/me"
      class="me-center"
      on:click={toggleMenu}
    >
      <span class="me-number">05</span>
      <span class="me-name">Me.</span>
    </a>
  </div>

  <div class="menu-footer">
    <p>&copy; 2026 Abdulla AlBassam</p>
    <p>Built with Astro + Three.js</p>
  </div>
</div>

<style>
  /* Header */
  .header {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 50;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem 2.5rem;
    pointer-events: none;
  }

  .header > * {
    pointer-events: auto;
  }

  .logo {
    font-family: "Space Grotesk", sans-serif;
    font-size: 1.6rem;
    font-weight: 700;
    color: white;
    text-decoration: none;
    letter-spacing: -0.02em;
    transition: opacity 0.2s;
  }

  .logo:hover {
    opacity: 0.7;
  }

  .hamburger {
    display: flex;
    flex-direction: column;
    gap: 6px;
    background: none;
    border: none;
    cursor: pointer;
    padding: 8px;
  }

  .hamburger-line {
    display: block;
    width: 26px;
    height: 2px;
    background: white;
    border-radius: 1px;
    transition: transform 0.3s, opacity 0.3s;
  }

  /* Menu overlay */
  .menu-overlay {
    position: fixed;
    inset: 0;
    z-index: 100;
    background: #0a0a0a;
    display: flex;
    flex-direction: column;
    opacity: 0;
    visibility: hidden;
    transition:
      opacity 0.5s cubic-bezier(0.4, 0, 0.2, 1),
      visibility 0.5s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .menu-overlay.open {
    opacity: 1;
    visibility: visible;
  }

  .menu-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem 2.5rem;
    flex-shrink: 0;
  }

  .close-btn {
    background: none;
    border: none;
    color: white;
    cursor: pointer;
    padding: 8px;
    transition: opacity 0.2s;
  }

  .close-btn:hover {
    opacity: 0.6;
  }

  /* Grid */
  .menu-grid {
    flex: 1;
    display: grid;
    margin: 0 2.5rem;
    position: relative;
    transition:
      grid-template-columns 0.6s cubic-bezier(0.4, 0, 0.2, 1),
      grid-template-rows 0.6s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .menu-cell {
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 2.5rem;
    border: 1px solid #1a1a1a;
    text-decoration: none;
    color: white;
    transition:
      background-color 0.4s ease,
      border-color 0.4s ease;
    overflow: hidden;
    position: relative;
  }

  .menu-cell:hover {
    background-color: #111111;
    border-color: #2a2a2a;
  }

  .cell-number {
    font-family: "Space Grotesk", sans-serif;
    font-size: 0.75rem;
    color: #555;
    letter-spacing: 0.12em;
    margin-bottom: 1rem;
  }

  .cell-name {
    font-family: "Space Grotesk", sans-serif;
    font-size: clamp(2rem, 5vw, 5rem);
    font-weight: 700;
    letter-spacing: -0.03em;
    line-height: 1;
    transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .menu-cell:hover .cell-name {
    transform: translateX(10px);
  }

  /* Center "Me" hub */
  .me-center {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 130px;
    height: 130px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 0.4rem;
    background: #0a0a0a;
    border: 1px solid #1a1a1a;
    border-radius: 0.75rem;
    text-decoration: none;
    color: white;
    z-index: 2;
    transition:
      transform 0.4s cubic-bezier(0.4, 0, 0.2, 1),
      background-color 0.4s ease,
      border-color 0.4s ease;
  }

  .me-center:hover {
    transform: translate(-50%, -50%) scale(1.12);
    background-color: #111111;
    border-color: #2a2a2a;
  }

  .me-number {
    font-family: "Space Grotesk", sans-serif;
    font-size: 0.65rem;
    color: #555;
    letter-spacing: 0.12em;
  }

  .me-name {
    font-family: "Space Grotesk", sans-serif;
    font-size: 1.8rem;
    font-weight: 700;
    letter-spacing: -0.03em;
    line-height: 1;
  }

  /* Footer */
  .menu-footer {
    display: flex;
    justify-content: space-between;
    padding: 1.5rem 2.5rem;
    color: #444;
    font-size: 0.75rem;
    font-family: "Inter", sans-serif;
    flex-shrink: 0;
  }

  /* Mobile */
  @media (max-width: 768px) {
    .header {
      padding: 1.25rem 1.5rem;
    }

    .menu-top {
      padding: 1.25rem 1.5rem;
    }

    .menu-grid {
      margin: 0 1.5rem;
      grid-template-columns: 1fr !important;
      grid-template-rows: 1fr 1fr 1fr 1fr !important;
    }

    .menu-cell {
      padding: 1.5rem;
    }

    .cell-name {
      font-size: 2.5rem;
    }

    .me-center {
      position: static;
      transform: none;
      width: 100%;
      height: auto;
      border-radius: 0;
      padding: 1.5rem;
      flex-direction: row;
      align-items: center;
      justify-content: flex-start;
      gap: 0;
    }

    .me-center:hover {
      transform: none;
      background-color: #111111;
      border-color: #2a2a2a;
    }

    .me-number {
      font-size: 0.75rem;
      margin-right: 1rem;
    }

    .me-name {
      font-size: 2.5rem;
    }
  }
</style>
