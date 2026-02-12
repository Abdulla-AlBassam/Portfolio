<script lang="ts">
  import SectionHeading from "./SectionHeading.svelte";
  import ScrollReveal from "./ScrollReveal.svelte";

  const categories = [
    {
      name: "Mobile App Development",
      icon: "M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z",
      projects: [
        {
          title: "Project Title",
          description: "Brief description of what this project does and the problem it solves.",
          tags: ["React Native", "Firebase"],
          link: "#",
        },
      ],
    },
    {
      name: "Cybersecurity",
      icon: "M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z",
      projects: [
        {
          title: "Project Title",
          description: "Brief description of what this project does and the problem it solves.",
          tags: ["Python", "Nmap"],
          link: "#",
        },
      ],
    },
    {
      name: "Networking",
      icon: "M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z",
      projects: [
        {
          title: "Project Title",
          description: "Brief description of what this project does and the problem it solves.",
          tags: ["GNS3", "OSPF"],
          link: "#",
        },
      ],
    },
  ];
</script>

<section id="projects" class="py-24">
  <div class="section-container">
    <ScrollReveal>
      <SectionHeading
        label="Projects"
        title="What I've Built"
        description="Hands-on projects across mobile development, cybersecurity, and networking."
      />
    </ScrollReveal>

    <div class="space-y-12">
      {#each categories as category, ci}
        <ScrollReveal delay={ci * 100}>
          <div>
            <!-- Category header -->
            <div class="flex items-center gap-3 mb-6">
              <div class="p-2 rounded-lg bg-white/5 border border-white/5">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="18"
                  height="18"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  class="text-accent"
                >
                  <path d={category.icon}></path>
                </svg>
              </div>
              <h3 class="font-semibold text-lg">{category.name}</h3>
            </div>

            <!-- Project cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
              {#each category.projects as project}
                <a
                  href={project.link}
                  class="group block p-5 rounded-xl border border-border bg-bg-surface hover:border-border-hover hover:bg-bg-elevated transition-all duration-200"
                >
                  <h4 class="font-medium group-hover:text-accent transition-colors">
                    {project.title}
                  </h4>
                  <p class="text-sm text-text-secondary mt-2 leading-relaxed">
                    {project.description}
                  </p>
                  <div class="flex flex-wrap gap-2 mt-4">
                    {#each project.tags as tag}
                      <span
                        class="px-2 py-0.5 text-xs font-mono rounded bg-white/5 text-text-muted border border-white/5"
                      >
                        {tag}
                      </span>
                    {/each}
                  </div>
                </a>
              {/each}

              <!-- Add more placeholder -->
              <div
                class="flex items-center justify-center p-5 rounded-xl border border-dashed border-border text-text-muted text-sm"
              >
                More coming soon
              </div>
            </div>
          </div>
        </ScrollReveal>
      {/each}
    </div>
  </div>
</section>
