<?php
  $section->add_classes([
    'relative'
  ]);

  // Get the first project with a virtual tour
  $args = array(
    'post_type' => 'project',
    'posts_per_page' => 1,
    'meta_query' => array(
      array(
        'key' => 'virtual_tour',
        'value' => '',
        'compare' => '!='
      )
    )
  );
  $first_project = get_posts($args);
  $default_project_id = $first_project ? $first_project[0]->ID : '';
?>

<?php $section->start(); ?>
  <div class="container px-4 mx-auto" x-data="virtualTours">
    <div class="text-center">
      <h2 class="mb-4 text-xl font-bold lg:text-2xl font-heading">Select A Virtual Tour</h2>
      <select x-model="selectedProject" @change="updateUrl" class="p-2 w-auto text-[20px] mb-4 border rounded">
        <option value="">Select a project</option>
        <?php
        $args = array(
          'post_type' => 'project',
          'posts_per_page' => -1,
          'meta_query' => array(
            array(
              'key' => 'virtual_tour',
              'value' => '',
              'compare' => '!='
            )
          )
        );
        $projects = get_posts($args);
        foreach ($projects as $project) :
          $project_id = $project->ID;
          echo "<option value=\"{$project_id}\">{$project->post_title}</option>";
        endforeach;
        ?>
      </select>
    </div>

    <template x-if="selectedProject">
      <div>
        <div class="w-full mb-6 overflow-hidden rounded-lg virtual-tour aspect-w-16 aspect-h-9">
          <iframe class="w-full h-full" :src="virtualTourUrl">Your browser doesn't support iframes. Please upgrade your browser</iframe>
        </div>
        <div class="text-center">
          <a :href="projectUrl" class="inline-block button button-primary">View Full Project</a>
        </div>
      </div>
    </template>
  </div>

  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.data('virtualTours', () => ({
        selectedProject: '<?php echo isset($_GET['project_id']) ? intval($_GET['project_id']) : $default_project_id; ?>',
        projectTitle: '',
        virtualTourUrl: '',
        projectUrl: '',
        updateUrl() {
          window.location.href = '?project_id=' + this.selectedProject;
        },
        async init() {
          if (this.selectedProject) {
            await this.fetchProjectData();
          }
        },
        async fetchProjectData() {
          try {
            const response = await fetch(`/wp-json/wp/v2/project/${this.selectedProject}`);
            if (!response.ok) throw new Error('Network response was not ok');
            const projectData = await response.json();
            this.projectTitle = projectData.title.rendered;
            this.virtualTourUrl = projectData.acf.virtual_tour;
            this.projectUrl = projectData.link;
          } catch (error) {
            console.error('Error fetching project data:', error);
          }
        }
      }))
    })
  </script>
<?php $section->end(); ?>