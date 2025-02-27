<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'make:puml',
    description: 'Create puml class diagram from Entities',
)]
class PumlCommand extends Command
{
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {

        $this->manager = $manager;
        parent::__construct();
    }


    protected function configure(): void {}

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Load all classes
        $this->manager->getMetadataFactory()->getAllMetadata();

        $entities = [];

        foreach (get_declared_classes() as $value) {
            $entity_name = "";
            $reflector = new \ReflectionClass($value);
            $attr = $reflector->getAttributes();
            // Get entity's short name
            $entity_name = array_reduce($attr, fn($previous, $a) => $a->getName() == "Doctrine\ORM\Mapping\Entity" ? $previous . $reflector->getShortName() : $previous);
            // Is there an entity ???
            if ($entity_name) {
                $properties = [];
                $reflection_properties = $reflector->getProperties();
                // view all properties...
                foreach ($reflection_properties as $property) {
                    $property_attritbutes = $property->getAttributes();
                    @$property_type = end(explode("\\", $property->getType()));
                    $property_type = substr($property_type, 0, 1) == "?" ? substr($property_type, 1) : $property_type;
                    // Get attributes of property 
                    foreach ($property_attritbutes as $attribute) {
                        // It's a simple column
                        if ($attribute->getName() == "Doctrine\ORM\Mapping\Column") {
                            $properties[] = [$property->getName(), $property_type, null, null, null];
                        } else {
                            // It's a relation
                            @$attribute_short_name = end(explode("\\", $attribute->getName()));
                            if (in_array($attribute_short_name, ["OneToMany", "ManyToOne", "ManyToMany", "OneToOne"])) {
                                $target_entity_type = null;
                                foreach ($attribute->getArguments() as $arg_k => $arg_v) {
                                    // Get target entity type
                                    if ($arg_k == "targetEntity") {
                                        $target_entity_type = @end(explode("\\", $arg_v));
                                    }
                                    // Get target property name
                                    if ($arg_k == "inversedBy" || $arg_k == "mappedBy") {
                                        $target_property_name = @end(explode("\\", $arg_v));
                                    }
                                }
                                if ($target_entity_type == null) $target_entity_type = $property_type;
                                if ($property_type == "Collection") $property_type = "" . $target_entity_type . "[]";
                                $properties[] = [$property->getName(), $property_type, $attribute_short_name, $target_entity_type, $target_property_name];
                            }
                        }
                    }
                }
                $entities[$entity_name] = $properties;
            }
        }


        // Generate puml class data
        $data = "@startuml\n";
        foreach ($entities as $entity_name => $properties) {
            $data .= "class $entity_name {\n";
            foreach ($properties as $property) {
                $data .= "\t";
                if ($property[2] != null) $data .= "<color:#0000dd>";
                if ($property[0] == "id") $data .= "**";
                $data .= "{$property[0]} : {$property[1]}";
                if ($property[0] == "id") $data .= "**";
                if ($property[2] != null) $data .= "</color>";
                $data .= "\n";
            }
            $data .= "}\n\n";
        }

        $done_links = [];
        // Generate puml class link
        foreach ($entities as $entity_name => $properties) {
            foreach ($properties as $property) {
                // It's a link
                if ($property[2] != null) {
                    $target = $property[3];

                    // find redondant link
                    $found = false;
                    foreach ($done_links as $line) {
                        if (
                            ($line[0] == $entity_name && $line[1] == $property[4] && $line[2] == $property[3] && $line[3] == $property[0])
                            || ($line[2] == $entity_name && $line[1] == $property[4] && $line[0] == $property[3] && $line[3] == $property[0])

                        ) {
                            $found = true;
                        }
                    }

                    if ($found == false) {

                        $data .= "{$entity_name}";
                        if ($property[2] == "OneToMany") $data .= " \"1\"--\"*\" ";
                        if ($property[2] == "ManyToOne") $data .= " \"*\"--\"1\" ";
                        if ($property[2] == "ManyToMany") $data .= " \"*\"--\"*\" ";
                        if ($property[2] == "OneToOne") $data .= " \"1\"--\"1\" ";
                        $data .= "{$target}\n";

                        $done_links[] = [$entity_name, $property[0], $property[3], $property[4]];
                    }
                }
            }
        }

        // var_dump($entities);
        // var_dump($data);
        // var_dump($done_links);

        $data .= "\n\nhide methods\n";
        $data .= "\nhide circle\n\n@enduml\n";

        if (!file_exists('puml/')) {
            mkdir('puml');
        }

        file_put_contents("./puml/index.puml", $data);

        $handle = popen("plantuml -pipe > puml/index.png", "w");
        if ($handle) {
            fwrite($handle, $data);
            pclose($handle);
        } else {
            echo "\n";
            return Command::FAILURE;
        }



        return Command::SUCCESS;
    }
}
