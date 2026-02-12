<script>
  import { onMount } from "svelte";

  let container;

  onMount(async () => {
    const THREE = await import("three");

    const width = container.clientWidth;
    const height = container.clientHeight;

    // Scene
    const scene = new THREE.Scene();

    // Camera
    const camera = new THREE.PerspectiveCamera(45, width / height, 0.1, 100);
    camera.position.z = 7;

    // Renderer
    const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    renderer.setSize(width, height);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    renderer.setClearColor(0x000000, 0);
    renderer.toneMapping = THREE.ACESFilmicToneMapping;
    renderer.toneMappingExposure = 1.2;
    container.appendChild(renderer.domElement);

    // Lights
    const ambientLight = new THREE.AmbientLight(0x404040, 3);
    scene.add(ambientLight);

    const dirLight1 = new THREE.DirectionalLight(0xffffff, 2);
    dirLight1.position.set(5, 5, 5);
    scene.add(dirLight1);

    const dirLight2 = new THREE.DirectionalLight(0x666666, 1);
    dirLight2.position.set(-5, -3, -5);
    scene.add(dirLight2);

    const pointLight = new THREE.PointLight(0x888888, 1.5, 20);
    pointLight.position.set(0, 3, 3);
    scene.add(pointLight);

    // Sphere cluster
    const group = new THREE.Group();

    const sphereConfigs = [
      { x: 0, y: 0, z: 0, r: 1.15, color: 0x1e1e1e, metalness: 0.1, roughness: 0.55 },
      { x: 1.5, y: 0.7, z: -0.6, r: 0.72, color: 0x2d2d2d, metalness: 0.2, roughness: 0.4 },
      { x: -1.25, y: 0.55, z: 0.35, r: 0.58, color: 0x252525, metalness: 0.15, roughness: 0.5 },
      { x: 1.0, y: -0.95, z: 0.5, r: 0.78, color: 0x343434, metalness: 0.1, roughness: 0.6 },
      { x: -1.05, y: -1.05, z: -0.4, r: 0.52, color: 0x222222, metalness: 0.2, roughness: 0.45 },
      { x: 0.25, y: 1.45, z: 0.3, r: 0.42, color: 0x3a3a3a, metalness: 0.1, roughness: 0.5 },
      { x: -1.65, y: -0.25, z: -0.3, r: 0.62, color: 0x2a2a2a, metalness: 0.15, roughness: 0.5 },
      { x: 1.75, y: -0.15, z: 0.2, r: 0.48, color: 0x323232, metalness: 0.2, roughness: 0.4 },
      { x: -0.4, y: -1.55, z: 0.6, r: 0.38, color: 0x404040, metalness: 0.1, roughness: 0.55 },
      { x: 0.65, y: 0.65, z: 0.95, r: 0.32, color: 0x454545, metalness: 0.15, roughness: 0.5 },
      { x: -0.6, y: 1.25, z: -0.55, r: 0.28, color: 0x303030, metalness: 0.2, roughness: 0.45 },
      { x: 1.3, y: 1.1, z: 0.1, r: 0.22, color: 0x4a4a4a, metalness: 0.1, roughness: 0.5 },
    ];

    sphereConfigs.forEach(({ x, y, z, r, color, metalness, roughness }) => {
      const geometry = new THREE.SphereGeometry(r, 64, 64);
      const material = new THREE.MeshPhysicalMaterial({
        color,
        metalness,
        roughness,
        clearcoat: 0.3,
        clearcoatRoughness: 0.4,
      });
      const mesh = new THREE.Mesh(geometry, material);
      mesh.position.set(x, y, z);
      mesh.userData = {
        originalY: y,
        speed: 0.25 + Math.random() * 0.35,
        offset: Math.random() * Math.PI * 2,
      };
      group.add(mesh);
    });

    scene.add(group);

    // Mouse tracking
    let mouseX = 0;
    let mouseY = 0;
    const mouse2D = new THREE.Vector2();
    const raycaster = new THREE.Raycaster();
    const mouseWorld = new THREE.Vector3();

    // Store velocity and original positions for physics
    group.children.forEach((sphere) => {
      sphere.userData.originalX = sphere.position.x;
      sphere.userData.originalZ = sphere.position.z;
      sphere.userData.vx = 0;
      sphere.userData.vy = 0;
      sphere.userData.vz = 0;
    });

    const onMouseMove = (e) => {
      mouseX = (e.clientX / window.innerWidth - 0.5) * 2;
      mouseY = -(e.clientY / window.innerHeight - 0.5) * 2;
      mouse2D.x = (e.clientX / window.innerWidth) * 2 - 1;
      mouse2D.y = -(e.clientY / window.innerHeight) * 2 + 1;
    };
    window.addEventListener("mousemove", onMouseMove);

    // Animation loop
    const clock = new THREE.Clock();
    let animationId;

    const repulsionRadius = 2.8;
    const repulsionStrength = 0.12;
    const springStrength = 0.03;
    const damping = 0.88;

    const animate = () => {
      animationId = requestAnimationFrame(animate);
      const elapsed = clock.getElapsedTime();

      // Project mouse into 3D world at z=0 plane
      raycaster.setFromCamera(mouse2D, camera);
      const planeZ = new THREE.Plane(new THREE.Vector3(0, 0, 1), 0);
      raycaster.ray.intersectPlane(planeZ, mouseWorld);

      // Physics for each sphere
      group.children.forEach((sphere) => {
        const { originalX, originalY, originalZ, speed, offset } = sphere.userData;

        // Floating animation target
        const floatY = originalY + Math.sin(elapsed * speed + offset) * 0.06;

        // Calculate distance from mouse in world space
        const dx = sphere.position.x - mouseWorld.x;
        const dy = sphere.position.y - mouseWorld.y;
        const dist = Math.sqrt(dx * dx + dy * dy);

        // Repulsion force — strong when close, fades with distance
        if (dist < repulsionRadius && dist > 0.01) {
          const force = repulsionStrength * (1 - dist / repulsionRadius) * (1 - dist / repulsionRadius);
          sphere.userData.vx += (dx / dist) * force;
          sphere.userData.vy += (dy / dist) * force;
          sphere.userData.vz += (Math.random() - 0.5) * force * 0.3;
        }

        // Spring back to original position
        sphere.userData.vx += (originalX - sphere.position.x) * springStrength;
        sphere.userData.vy += (floatY - sphere.position.y) * springStrength;
        sphere.userData.vz += (originalZ - sphere.position.z) * springStrength;

        // Apply damping
        sphere.userData.vx *= damping;
        sphere.userData.vy *= damping;
        sphere.userData.vz *= damping;

        // Update position
        sphere.position.x += sphere.userData.vx;
        sphere.position.y += sphere.userData.vy;
        sphere.position.z += sphere.userData.vz;
      });

      // Mouse-responsive rotation (gentler now since spheres move individually)
      group.rotation.y += (mouseX * 0.08 - group.rotation.y) * 0.01;
      group.rotation.x += (mouseY * 0.04 - group.rotation.x) * 0.01;

      // Very slow idle rotation
      group.rotation.y += 0.0003;

      renderer.render(scene, camera);
    };

    animate();

    // Resize handler
    const onResize = () => {
      const w = container.clientWidth;
      const h = container.clientHeight;
      camera.aspect = w / h;
      camera.updateProjectionMatrix();
      renderer.setSize(w, h);
    };
    window.addEventListener("resize", onResize);

    // Cleanup
    return () => {
      cancelAnimationFrame(animationId);
      window.removeEventListener("mousemove", onMouseMove);
      window.removeEventListener("resize", onResize);
      renderer.dispose();
    };
  });
</script>

<div bind:this={container} class="three-container"></div>

<style>
  .three-container {
    position: absolute;
    inset: 0;
    z-index: 0;
  }
</style>
