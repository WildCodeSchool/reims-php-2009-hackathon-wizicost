<?php

namespace App\Controller;

use App\Entity\Resource;
use App\Entity\Category;
use App\Entity\MachineType;
use App\Form\ModelType;
use App\Form\ResourceType;
use App\Repository\ResourceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use App\Form\ResourceNameType;
use App\Form\ResourceCategoryType;
use App\Form\ResourceMachineType;
use App\Form\ResourceModelType;
use App\Form\ResourceOptionType;
use App\Repository\BrandRepository;
use App\Repository\CategoryRepository;
use App\Repository\MachineTypeRepository;
use App\Repository\ModelRepository;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * @Route("/resource")
 */
class ResourceController extends AbstractController
{
     /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("/", name="resource_index", methods={"GET"})
     */
    public function index(ResourceRepository $resourceRepository): Response
    {
        $user = $this->security->getUser();

        $resources =  $resourceRepository->findBy(['user' => $user]);
        return $this->render('resource/index.html.twig', [
            'resources' => $resources,
        ]);
    }

    /**
     * @Route("/new", name="resource_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        //Ressource -> Category -> MachineType -> Model -> Option
        $resource = new Resource();
        $form = $this->createForm(ResourceNameType::class, $resource);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $resource = $resource->setUser($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($resource);
            $entityManager->flush();
            return $this->redirectToRoute('resource_new_category', ['id' => $resource->getid(), $request]);
        }
        return $this->render('resource/new.html.twig', [
            'resource' => $resource,
            'form' => $form->createView(),
        ]);
    }

     /**
     * @Route("/{id}/newCategory", name="resource_new_category", methods={"GET","POST"})
     */
    public function newCategoryForResource(CategoryRepository $categoryRepository, Resource $resource, Request $request): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('resource/category.html.twig', ['categories' => $categories, 'resource' => $resource]);
    }

    /**
     * @Route("/{resource}/{category}/newMachineType", name="resource_new_machine_type", methods={"GET","POST"})
     */
    public function newMachineTypeForResource(Resource $resource, Category $category, Request $request, MachineTypeRepository $machineTypeRepository): Response
    {
        $resource->setCategory($category);
        $machineTypeObjects = $machineTypeRepository->findBy(['Category' => $category]);
        $machineTypes = [];

        $formMachineType = $this->createForm(ResourceMachineType::class, $resource);
        foreach ($machineTypeObjects as $machineTypeObject) {
            $machineType = $machineTypeObject->getType();
            $machineTypes[$machineType] = $machineTypeObject->getId();
        }
        $formMachineType->add('machineType', ChoiceType::class, ['choices' => $machineTypes]);
        $formMachineType->handleRequest($request);
        if ($formMachineType->isSubmitted() && $formMachineType->isValid()) {
            $ResourceMachineType = $formMachineType->get('machineType')->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($resource);
            $entityManager->flush();
            return $this->redirectToRoute('resource_new_model', [
                'resource' => $resource->getid(),
                'category' => $category->getId(),
                'machineType' => $ResourceMachineType,
                $request]);
        }
        return $this->render('resource/new.html.twig', [
            'resource' => $resource,
            'form' => $formMachineType->createView(),
            'machineTypes' => $machineTypes,
        ]);
    }

     /**
     * @Route("/{resource}/{category}/{machineType}/newBrand", name="resource_new_brand", methods={"GET","POST"})
     */
    public function newBrandForResource(Resource $resource, Category $category, MachineType $machineType, Request $request, BrandRepository $brandRepository): Response
    {
        $brandObjects = $brandRepository->findBy(['Category' => $category]);
        $brands = [];

        $formbrand = $this->createForm(Resourcebrand::class, $resource);
        foreach ($brandObjects as $brandObject) {
            $brand = $brandObject->getBrand();
            $brands[$brand] = $brandObject->getId();
        }
        $formbrand->add('brand', ChoiceType::class, ['choices' => $brands]);
        $formbrand->handleRequest($request);
        if ($formbrand->isSubmitted() && $formbrand->isValid()) {
            $Resourcebrand = $formbrand->get('brand')->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($resource);
            $entityManager->flush();
            return $this->redirectToRoute('resource_new_model', [
                'resource' => $resource->getid(),
                'category' => $category->getId(),
                'brand' => $Resourcebrand,
                $request]);
        }
        return $this->render('resource/new.html.twig', [
            'resource' => $resource,
            'form' => $formbrand->createView(),
            'brands' => $brands,
        ]);
    }

     /**
     * @Route("/{resource}/{category}/{machineType}/newModel", name="resource_new_model", methods={"GET","POST"})
     */
    public function newModelForResource(Resource $resource, Category $category, MachineType $machineType, ModelRepository $modelRepository, Request $request): Response
    {
        $modelObjects = $modelRepository->findBy(['machineType' => $machineType]);
        $models = [];
        $formModel = $this->createForm(ResourceModelType::class, $resource);
        foreach ($modelObjects as $modelObject) {
            $model = $modelObject->getBrand();
            $models[$model] = $modelObject->getId();
        }
        $formModel->add('model', ChoiceType::class, ['choices' => $models]);
        $formModel->handleRequest($request);
        if ($formModel->isSubmitted() && $formModel->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($resource);
            $entityManager->flush();
            return $this->redirectToRoute('resource_new_option', ['id' => $resource->getid(), $request]);
        }
        return $this->render('resource/new.html.twig', [
            'resource' => $resource,
            'form' => $formModel->createView(),
        ]);
    }

    /**
     * @Route("/{id}/newOption", name="resource_new_option", methods={"GET","POST"})
     */
    public function newOptionForResource(Resource $resource, Request $request): Response
    {
        $formOption = $this->createForm(ResourceOptionType::class, $resource);
        $formOption->handleRequest($request);
        if ($formOption->isSubmitted() && $formOption->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($resource);
            $entityManager->flush();
            return $this->redirectToRoute('resource_show', ['id' => $resource->getid()]);
        }
        return $this->render('resource/new.html.twig', [
            'resource' => $resource,
            'form' => $formOption->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="resource_show", methods={"GET"})
     */
    public function show(Resource $resource): Response
    {
        return $this->render('resource/show.html.twig', [
            'resource' => $resource,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="resource_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Resource $resource): Response
    {
        $form = $this->createForm(ResourceType::class, $resource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('resource_index');
        }

        return $this->render('resource/edit.html.twig', [
            'resource' => $resource,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="resource_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Resource $resource): Response
    {
        if ($this->isCsrfTokenValid('delete' . $resource->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($resource);
            $entityManager->flush();
        }

        return $this->redirectToRoute('resource_index');
    }
}
